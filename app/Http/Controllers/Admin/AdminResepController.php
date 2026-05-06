<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::latest()->paginate(10);
        return view('admin.resep.index', compact('reseps'));
    }

    public function create()
    {
        return view('admin.resep.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string',
            'deskripsi' => 'required|string',
            'waktu'     => 'required|integer|min:1',
            'level'     => 'required|string',
            'harga'     => 'required|integer|min:0',
            'bahan'     => 'required|string',
            'langkah'   => 'required|string',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('resep', 'public');
        }

        Resep::create([
            'nama'        => $request->nama,
            'slug'        => Str::slug($request->nama) . '-' . Str::random(4),
            'kategori'    => $request->kategori,
            'badge'       => $request->badge ?? 'NEW',
            'badge_color' => $request->badge_color ?? '#FF5C00',
            'emoji'       => $request->emoji ?? '🧀',
            'waktu'       => $request->waktu,
            'level'       => $request->level,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'bahan'       => array_filter(explode("\n", trim($request->bahan))),
            'langkah'     => array_filter(explode("\n", trim($request->langkah))),
            'tips'        => $request->tips,
            'gambar'      => $gambar,
            'aktif'       => $request->has('aktif'),
        ]);

        return redirect()->route('admin.resep.index')
            ->with('sukses', 'Resep berhasil ditambahkan!');
    }

    public function edit(Resep $resep)
    {
        return view('admin.resep.edit', compact('resep'));
    }

    public function update(Request $request, Resep $resep)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string',
            'deskripsi' => 'required|string',
            'waktu'     => 'required|integer|min:1',
            'level'     => 'required|string',
            'harga'     => 'required|integer|min:0',
            'bahan'     => 'required|string',
            'langkah'   => 'required|string',
        ]);

        $data = [
            'nama'        => $request->nama,
            'kategori'    => $request->kategori,
            'badge'       => $request->badge ?? 'NEW',
            'badge_color' => $request->badge_color ?? '#FF5C00',
            'emoji'       => $request->emoji ?? '🧀',
            'waktu'       => $request->waktu,
            'level'       => $request->level,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
            'bahan'       => array_filter(explode("\n", trim($request->bahan))),
            'langkah'     => array_filter(explode("\n", trim($request->langkah))),
            'tips'        => $request->tips,
            'aktif'       => $request->has('aktif'),
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('resep', 'public');
        }

        $resep->update($data);

        return redirect()->route('admin.resep.index')
            ->with('sukses', 'Resep berhasil diperbarui!');
    }

    public function destroy(Resep $resep)
    {
        $resep->delete();
        return back()->with('sukses', 'Resep berhasil dihapus!');
    }
}