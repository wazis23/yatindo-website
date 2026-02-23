<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function teachers()
    {
    return $this->hasMany(Teacher::class);
    }
    use HasRoles;
    protected $fillable = [
        'name',
        'type',
        'description',
        'accreditation_no',
        'brochure_file',
        'headmaster_name',
        'headmaster_photo'
    ];
    public function facilities()
    {
    return $this->hasMany(Facility::class);
    }
    public function extracurriculars()
    {
    return $this->hasMany(Extracurricular::class);
    }
}
