<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['kategori_id', 'nama', 'slug', 'deskripsi', 'harga', 'stok', 'gambar', 'satuan', 'aktif'];

    public function kategori()
    {
    return $this->belongsTo(Kategori::class)->withDefault([
        'nama' => 'Tanpa Kategori',
    ]);
}

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}