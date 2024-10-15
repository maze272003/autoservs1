<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'carModel',
        'serviceType',
        'carIssue',
        'appointmentDate',
        'appointmentTime',
        'plateNumber', // Changed from phoneNumber to plateNumber
        'additionalNotes',
        'user_id' // Assuming the user_id is used for the authenticated user

    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
