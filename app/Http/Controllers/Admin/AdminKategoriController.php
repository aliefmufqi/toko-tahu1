<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('produks')->latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama) . '-' . Str::random(4),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('sukses', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('sukses', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
{
    // Set produk di kategori ini jadi null kategorinya
    \App\Models\Produk::where('kategori_id', $kategori->id)
        ->update(['kategori_id' => null]);

    $kategori->delete();
    return back()->with('sukses', 'Kategori berhasil dihapus!');
}
}