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
        'user_id', // Include user_id in fillable fields
        'read',    // Include read to track if the message has been read
    ];

    // Define the relationship with the Reply model
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
