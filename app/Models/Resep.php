<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $fillable = [
        'nama', 'slug', 'kategori', 'badge', 'badge_color',
        'emoji', 'waktu', 'level', 'harga', 'deskripsi',
        'bahan', 'langkah', 'tips', 'gambar', 'aktif',
    ];

    protected $casts = [
        'bahan'   => 'array',
        'langkah' => 'array',
        'aktif'   => 'boolean',
    ];
}