<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building_id',
        'is_active'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
