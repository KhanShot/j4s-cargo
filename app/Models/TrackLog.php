<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'city', 'track_id', 'text', 'status', 'track_status', 'scanned_code'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
