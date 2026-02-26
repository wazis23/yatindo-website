<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'author_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTO SLUG
    |--------------------------------------------------------------------------
    */
    protected static function booted()
        {
            static::deleting(function ($post) {

                // Hapus featured image
                if ($post->featured_image) {
                    Storage::disk('public')->delete($post->featured_image);
                }

                // Hapus semua gambar dari konten
                preg_match_all('/storage\/posts\/(.*?)"/', $post->content, $matches);

                if (!empty($matches[1])) {
                    foreach ($matches[1] as $file) {
                        Storage::disk('public')->delete('posts/' . $file);
                    }
                }
            });
        }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (!$post->slug) {
                $post->slug = static::generateUniqueSlug($post->title);
            }
        });
    }

    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}