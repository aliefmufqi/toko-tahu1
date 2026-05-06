<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori')->where('aktif', true);

        if ($request->kategori) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }

        $produks   = $query->latest()->paginate(12);
        $kategoris = Kategori::all();

        return view('produk.index', compact('produks', 'kategoris'));
    }

    public function show($slug)
    {
        $produk = Produk::with('kategori')
            ->where('slug', $slug)
            ->where('aktif', true)
            ->firstOrFail();

        return view('produk.show', compact('produk'));
    }
}