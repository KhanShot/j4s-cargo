<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'description', 'user_id', 'weight', 'state', 'city',
        'status', 'scanned_city', 'scanned_user_id', 'scanned_time', 'status_changed_time'
    ];

    public function user(){
        return  $this->belongsTo(User::class, 'user_id');
    }
}
