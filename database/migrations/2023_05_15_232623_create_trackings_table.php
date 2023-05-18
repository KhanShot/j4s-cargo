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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable()->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->nullOnDelete();
            $table->float('weight')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('status')->nullable()->default('created');
            $table->string('scanned_city')->nullable();
            $table->unsignedBigInteger("scanned_user_id")->nullable();
            $table->foreign('scanned_user_id')->references('id')
                ->on('users')->nullOnDelete();
            $table->dateTime('scanned_time')->nullable();
            $table->dateTime('status_changed_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
