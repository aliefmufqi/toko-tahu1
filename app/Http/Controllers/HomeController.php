<?php
namespace App\Http\Controllers;
use App\Models\{Produk, Kategori};

class HomeController extends Controller
{
    public function index()
    {
        $produkUnggulan = Produk::where('aktif', true)->latest()->take(8)->get();
        $kategoris = Kategori::all();
        return view('home', compact('produkUnggulan', 'kategoris'));
    }
}