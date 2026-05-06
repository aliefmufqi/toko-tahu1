<?php
namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $total = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
        return view('keranjang', compact('keranjang', 'total'));
    }

    public function tambah(Request $request)
{
    // Blokir admin
    if (auth()->check() && auth()->user()->isAdmin()) {
        return back()->with('error', 'Admin tidak bisa menambahkan produk ke keranjang!');
    }

    $produk = Produk::findOrFail($request->produk_id);
    $keranjang = session()->get('keranjang', []);

    if (isset($keranjang[$produk->id])) {
        $keranjang[$produk->id]['jumlah'] += $request->jumlah ?? 1;
    } else {
        $keranjang[$produk->id] = [
            'nama'   => $produk->nama,
            'harga'  => $produk->harga,
            'jumlah' => $request->jumlah ?? 1,
            'gambar' => $produk->gambar,
        ];
    }

    session()->put('keranjang', $keranjang);
    return back()->with('sukses', 'Produk berhasil ditambahkan ke keranjang!');
}

    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] = $request->jumlah;
            session()->put('keranjang', $keranjang);
        }
        return back();
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        unset($keranjang[$id]);
        session()->put('keranjang', $keranjang);
        return back()->with('cart_remove_success', 'Produk dihapus dari keranjang.');
    }
}