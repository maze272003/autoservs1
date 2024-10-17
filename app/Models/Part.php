<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_parts',
        'price',
        'quantity',
    ];

    // Relationship to ClientPart
    public function clientParts()
    {
        return $this->hasMany(ClientPart::class, 'parts_id');
    }
}
