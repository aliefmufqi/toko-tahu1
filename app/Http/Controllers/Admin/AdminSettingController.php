<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    use App\Helpers\UploadHelper;

public function update(Request $request)
{
    if ($request->hasFile('hero_image')) {
        $path = UploadHelper::upload($request->file('hero_image'), 'settings');
        Setting::set('hero_image', $path);
    }

    if ($request->filled('hero_title'))    Setting::set('hero_title', $request->hero_title);
    if ($request->filled('hero_subtitle')) Setting::set('hero_subtitle', $request->hero_subtitle);
    if ($request->filled('hero_badge'))    Setting::set('hero_badge', $request->hero_badge);
    if ($request->filled('nama_toko'))     Setting::set('nama_toko', $request->nama_toko);
    if ($request->filled('rekening_bank')) Setting::set('rekening_bank', $request->rekening_bank);
    if ($request->filled('no_rekening'))   Setting::set('no_rekening', $request->no_rekening);
    if ($request->filled('nama_rekening')) Setting::set('nama_rekening', $request->nama_rekening);
    if ($request->filled('ongkir'))        Setting::set('ongkir', $request->ongkir);
    if ($request->filled('whatsapp'))      Setting::set('whatsapp', $request->whatsapp);

    return back()->with('sukses', 'Pengaturan berhasil disimpan!');
}
}