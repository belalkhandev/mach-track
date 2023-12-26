<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'notable_type',
        'notable_id',
        'note'
    ];

    public function notable()
    {
        return $this->morphTo();
    }
}
