<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'description',
	'category'
    ];

    // Relasi: 1 album punya banyak foto
    public function photos()
    {
        return $this->hasMany(Gallery::class);
    }

    public function coverPhoto()
    {
    return $this->belongsTo(Gallery::class, 'cover_photo_id');
    }

}
