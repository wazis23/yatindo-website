<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'photo',
        'unit',
        'teacher_type',
        'subject',
        'position_id',
        'major_id',
        'is_active'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
