<?php
namespace App\Notifications;

use App\Models\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PesananBaruNotification extends Notification
{
    use Queueable;

    public function __construct(public Pesanan $pesanan) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'pesanan_id'    => $this->pesanan->id,
            'kode_pesanan'  => $this->pesanan->kode_pesanan,
            'customer'      => $this->pesanan->user->name,
            'total'         => $this->pesanan->total_harga,
            'status'        => $this->pesanan->status,
            'pesan'         => 'Pesanan baru dari ' . $this->pesanan->user->name,
            'url'           => route('admin.pesanan.show', $this->pesanan->id),
        ];
    }
}