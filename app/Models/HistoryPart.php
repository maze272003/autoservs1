<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPart extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = [
        'history_car_id', 
        'part_id', 
        'part_name', 
        'part_price'
    ];

    /**
     * Define the relationship with the Part model.
     * A HistoryPart belongs to a single Part.
     */
    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    /**
     * Define the relationship with HistoryCar model.
     * A HistoryPart belongs to a single HistoryCar.
     */
    public function historyCar()
    {
        return $this->belongsTo(HistoryCar::class, 'history_car_id');
    }

    /**
     * Get the formatted part price.
     *
     * @return string
     */
    public function getFormattedPartPriceAttribute()
    {
        return number_format($this->part_price, 2); // Format the price to two decimal places
    }
}
