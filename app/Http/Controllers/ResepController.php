<?php
namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $reseps    = Resep::where('aktif', true)->latest()->get();
        $kategoris = ['Street Style', 'Vegan Specials', 'Quick & Spicy'];
        return view('resep.index', compact('reseps', 'kategoris'));
    }

    public function show($slug)
    {
        $resep  = Resep::where('slug', $slug)->where('aktif', true)->firstOrFail();
        $reseps = Resep::where('aktif', true)->where('slug', '!=', $slug)->take(3)->get();
        return view('resep.show', compact('resep', 'reseps'));
    }
}