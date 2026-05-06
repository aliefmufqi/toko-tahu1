<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // ← pastikan ini ada

class User extends Authenticatable
{
    use HasFactory, Notifiable; // ← pastikan Notifiable ada di sini

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telepon',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}