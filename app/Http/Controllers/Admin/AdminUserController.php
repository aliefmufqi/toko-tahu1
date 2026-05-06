<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.user.index', compact('users'));
    }

    public function show(User $user)
    {
        $pesanans = $user->pesanans()->latest()->get();
        return view('admin.user.show', compact('user', 'pesanans'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,customer',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.user.index')
            ->with('sukses', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $user)
{
    if ($user->id === auth()->id()) {
        return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
    }

    // Hapus semua pesanan user (cascade otomatis ke detail & pembayaran)
    $user->pesanans()->delete();
    $user->delete();

    return back()->with('sukses', 'Pengguna berhasil dihapus!');
}
}