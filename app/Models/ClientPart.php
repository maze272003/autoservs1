<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPart extends Model
{
    use HasFactory;

    // Specify the fillable attributes
    protected $fillable = ['user_id', 'parts_id', 'process_id'];

    // Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Part model
    public function part()
    {
        return $this->belongsTo(Part::class, 'parts_id');
    }

    // Relationship to Process model
    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id');
    }
    public function parts()
{
    return $this->belongsTo(Part::class, 'parts_id'); // Adjust if the foreign key differs
}

}
