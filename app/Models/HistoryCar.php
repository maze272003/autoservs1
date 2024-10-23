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
     * This means a single HistoryCar can have multiple HistoryParts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historyParts()
    {
        return $this->hasMany(HistoryPart::class, 'history_car_id'); // Ensure 'history_car_id' exists in your HistoryPart table
    }

    /**
     * Define the relationship with User (belongs to).
     * This means a HistoryCar belongs to a single User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Adjust the relationship as necessary
    }
}
