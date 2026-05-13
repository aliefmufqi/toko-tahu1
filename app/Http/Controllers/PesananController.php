<?php
namespace App\Http\Controllers;

use App\Models\{Pesanan, DetailPesanan, Produk, User};
use App\Notifications\PesananBaruNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\UploadHelper;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = auth()->user()->pesanans()->latest()->get();
        return view('pesanan.index', compact('pesanans'));
    }

    public function checkout()
    {
        $keranjang = session()->get('keranjang', []);
        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Keranjang masih kosong!');
        }
        $total = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
        return view('pesanan.checkout', compact('keranjang', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string',
            'telepon'           => 'required|string',
        ]);

        $keranjang = session()->get('keranjang', []);
        if (empty($keranjang)) {
            return redirect()->route('keranjang.index');
        }

        $totalHarga = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
        $ongkir     = 5000;

        $pesanan = Pesanan::create([
            'user_id'           => auth()->id(),
            'kode_pesanan'      => 'TH-' . strtoupper(Str::random(8)),
            'total_harga'       => $totalHarga + $ongkir,
            'ongkos_kirim'      => $ongkir,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'telepon'           => $request->telepon,
            'catatan'           => $request->catatan,
            'status'            => 'menunggu',
        ]);

        foreach ($keranjang as $id => $item) {
            DetailPesanan::create([
                'pesanan_id'   => $pesanan->id,
                'produk_id'    => $id,
                'jumlah'       => $item['jumlah'],
                'harga_satuan' => $item['harga'],
                'subtotal'     => $item['harga'] * $item['jumlah'],
            ]);
            Produk::where('id', $id)->decrement('stok', $item['jumlah']);
        }

        if ($request->metode_bayar === 'cod') {
            \App\Models\Pembayaran::create([
                'pesanan_id'     => $pesanan->id,
                'metode_bayar'   => 'cod',
                'jumlah_bayar'   => $pesanan->total_harga,
                'bukti_transfer' => null,
                'status'         => 'menunggu',
                'tanggal_bayar'  => now(),
            ]);
        }

        // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new PesananBaruNotification($pesanan));
        }

        session()->forget('keranjang');

        return redirect()->route('pesanan.show', $pesanan->kode_pesanan)
            ->with('sukses', $request->metode_bayar === 'cod'
                ? 'Pesanan COD berhasil dibuat! Siapkan uang saat kurir tiba.'
                : 'Pesanan berhasil dibuat! Silakan lakukan pembayaran transfer.');
    }

    public function show($kode)
    {
        $pesanan = Pesanan::where('kode_pesanan', $kode)
            ->where('user_id', auth()->id())
            ->with(['detailPesanans.produk', 'pembayaran'])
            ->firstOrFail();

        return view('pesanan.show', compact('pesanan'));
    }



public function bayar(Request $request, $kode)
{
    $request->validate(['bukti_transfer' => 'required|image|max:2048']);

    $pesanan = Pesanan::where('kode_pesanan', $kode)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $path = UploadHelper::upload($request->file('bukti_transfer'), 'pembayaran');

    \App\Models\Pembayaran::updateOrCreate(
        ['pesanan_id' => $pesanan->id],
        [
            'metode_bayar'   => 'transfer',
            'jumlah_bayar'   => $pesanan->total_harga,
            'bukti_transfer' => $path,
            'status'         => 'menunggu',
            'tanggal_bayar'  => now(),
        ]
    );

    return back()->with('sukses', 'Bukti pembayaran berhasil dikirim!');
}
}