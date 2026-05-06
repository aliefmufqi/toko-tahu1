<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NotifikasiController extends Controller
{
    // Ambil notifikasi terbaru (untuk polling)
    public function index()
    {
        $notifikasis = auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get()
            ->map(fn($n) => [
                'id'        => $n->id,
                'data'      => $n->data,
                'dibaca'    => !is_null($n->read_at),
                'waktu'     => $n->created_at->diffForHumans(),
            ]);

        $belumDibaca = auth()->user()->unreadNotifications()->count();

        return response()->json([
            'notifikasis' => $notifikasis,
            'belum_dibaca' => $belumDibaca,
        ]);
    }

    // Tandai semua sudah dibaca
    public function tandaiBaca()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['sukses' => true]);
    }

    // Tandai satu sudah dibaca
    public function tandaiBacaSatu($id)
    {
        $notif = auth()->user()->notifications()->findOrFail($id);
        $notif->markAsRead();
        return response()->json(['sukses' => true]);
    }

    // Hapus semua notifikasi
    public function hapusSemua()
    {
        auth()->user()->notifications()->delete();
        return response()->json(['sukses' => true]);
    }
}