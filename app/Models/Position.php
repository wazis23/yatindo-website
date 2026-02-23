<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}

