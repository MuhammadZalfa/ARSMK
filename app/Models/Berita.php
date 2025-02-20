<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'news'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'author_id',
        'title',
        'news_images',
        'content',
        'created_at',
        'updated_at'
    ];

    // Relasi dengan User (jika menggunakan sistem autentikasi)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Accessor untuk mengambil URL gambar
    public function getImageUrlAttribute()
    {
        return asset('storage/news_images/' . $this->news_images);
    }
}