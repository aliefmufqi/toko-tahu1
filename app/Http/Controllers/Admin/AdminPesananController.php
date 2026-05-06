<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('user')->latest();
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $pesanans = $query->paginate(15);
        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanans.produk', 'pembayaran'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);
        return back()->with('sukses', 'Status pesanan diperbarui!');
    }

    public function konfirmasiBayar($id)
    {
        $pesanan = Pesanan::with('pembayaran')->findOrFail($id);
        $pesanan->pembayaran?->update(['status' => 'dikonfirmasi']);
        $pesanan->update(['status' => 'diproses']);
        return back()->with('sukses', 'Pembayaran dikonfirmasi, pesanan diproses!');
    }
}