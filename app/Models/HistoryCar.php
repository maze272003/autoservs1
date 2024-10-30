<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCar extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
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

    /**
     * Define the relationship with HistoryPart (one-to-many).
     * A single HistoryCar can have multiple HistoryParts.
     */
    public function historyParts()
    {
        return $this->hasMany(HistoryPart::class, 'history_car_id');
    }

    /**
     * Define the relationship with User (belongs to).
     * A HistoryCar belongs to a single User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
