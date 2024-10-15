<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCar extends Model
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
        'additionalNotes'
    ];

    // Defining the relationship with HistoryPart (one-to-many)
    public function historyParts()
    {
        return $this->hasMany(HistoryPart::class, 'history_car_id'); // Single relationship definition
    }

    // Defining the relationship with User (belongs to)
    public function user()
    {
        return $this->belongsTo(User::class); // Adjust the relationship as necessary
    }
}
