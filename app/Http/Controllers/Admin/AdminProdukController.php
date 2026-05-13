<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Produk, Kategori};
use App\Helpers\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->paginate(15);
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'required',
        ]);

        $data = $request->except('gambar');
        $data['slug']  = Str::slug($request->nama) . '-' . Str::random(5);
        $data['aktif'] = $request->has('aktif') ? 1 : 0;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = UploadHelper::upload($request->file('gambar'), 'produk');
        }

        Produk::create($data);
        return redirect()->route('admin.produk.index')
            ->with('sukses', 'Produk berhasil ditambahkan!');
    }

    public function show(Produk $produk)
    {
        return redirect()->route('admin.produk.edit', $produk);
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->except('gambar');
        $data['aktif'] = $request->has('aktif') ? 1 : 0;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = UploadHelper::upload($request->file('gambar'), 'produk');
        }

        $produk->update($data);
        return redirect()->route('admin.produk.index')
            ->with('sukses', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        \App\Models\DetailPesanan::where('produk_id', $produk->id)
            ->update(['produk_id' => null]);
        $produk->delete();
        return back()->with('sukses', 'Produk berhasil dihapus!');
    }
}