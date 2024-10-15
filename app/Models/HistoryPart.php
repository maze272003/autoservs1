<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPart extends Model
{
    use HasFactory;

    protected $fillable = ['history_car_id', 'part_id', 'part_name', 'part_price']; // part_name and part_price added

    // Relationship with the Part model (one-to-one or many-to-one, depending on your structure)
    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    // Relationship with HistoryCar model (many-to-one)
    public function historyCar()
    {
        return $this->belongsTo(HistoryCar::class, 'history_car_id');
    }
}
