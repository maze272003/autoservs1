<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parts_id'];

    // Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Part model
    public function part()
    {
        return $this->belongsTo(Part::class, 'parts_id'); // Ensure 'parts_id' matches your actual foreign key
    }

    // Helper function to get parts as an array
    public function getPartsAsArray()
    {
        return $this->with('part')->get()->map(function ($clientPart) {
            return [
                'part_id' => $clientPart->part->id,
                'part_name' => $clientPart->part->name_parts,
                'price' => $clientPart->part->price,
            ];
        })->toArray();
    }
}
