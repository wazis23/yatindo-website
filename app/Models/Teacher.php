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

    public function majors()
    {
        return $this->belongsToMany(Major::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(
            \App\Models\Subject::class,
            'subject_teacher'
        );
    }
    
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
