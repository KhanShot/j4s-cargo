<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('track_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->nullOnDelete();
            $table->string('city')->nullable();
            $table->unsignedBigInteger("track_id")->nullable();
            $table->foreign('track_id')->references('id')
                ->on('trackings')->nullOnDelete();
            $table->string('text')->nullable();
            $table->string('scanned_code')->nullable();
            $table->string('status')->nullable();
            $table->string('track_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_logs');
    }
};
