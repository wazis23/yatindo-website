<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
	protected $fillable = [
        'title',          // judul berita
        'slug',           // slug url
        'content',        // isi berita
        'featured_image', // gambar utama
        'status',         // draft/published
        'author_id',      // user pembuat
        'published_at'    // waktu publish
    ];
}
