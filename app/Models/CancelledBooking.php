<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carModel',
        'serviceType',
        'carIssue',
        'appointmentDate',
        'appointmentTime',
        'plateNumber',
        'additionalNotes',
    ];
}
