<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'category',
        'album_id',
        'uploaded_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
	public function album()
{
    return $this->belongsTo(Album::class);
}
}
