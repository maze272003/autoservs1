<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Define the fillable fields in the messages table
    protected $fillable = [
        'email',
        'message',
    ];
}
