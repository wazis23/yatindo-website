<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','image','description','school_id'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
