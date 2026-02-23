<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'motto',
        'description',
        'is_active'
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
