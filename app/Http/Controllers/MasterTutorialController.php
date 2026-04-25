<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\MasterTutorial;
use Illuminate\Support\Str;

class MasterTutorialController extends Controller
{
    public function index()
    {$tutorials = MasterTutorial::all();
    
        return view('master_tutorial.index', compact('tutorials'));
    }

    public function create()
    {
        $token = Session::get('refreshToken');
        $baseUrl = config('services.jwt.url');

        $response = Http::withToken($token)
            ->get($baseUrl . '/getMakul');
    
        $makulData = []; 

        if ($response->successful()) {
            $makulData = $response->json('data') ?? []; 
        }
    
        return view('master_tutorial.create', compact('makulData'));
    }
public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'kode_mata_kuliah' => 'required',
        'creator_email' => 'required|email',
    ]);

    $slug = Str::slug($request->judul);
    $randomId = rand(111111, 999999);
    $finalSlug = $slug . '-' . $randomId;

    MasterTutorial::create([
        'judul' => $request->judul,
        'kode_mata_kuliah' => $request->kode_mata_kuliah,
        // Sesuaikan dengan rute di web.php yaitu /presentation/{slug}
        'url_presentation' => url("/presentation/" . $finalSlug),
        'url_finished' => url("/finished/" . $finalSlug), // Tetap simpan meski PDF dilewati
        'creator_email' => $request->creator_email,
    ]);

    return redirect('/master-tutorial')->with('success', 'Master Tutorial berhasil dibuat!');
}

    public function edit($id)
    {
        $tutorial = MasterTutorial::findOrFail($id);
        $token = Session::get('refreshToken');
        $baseUrl = config('services.jwt.url');
        
        $response = Http::withToken($token)->get($baseUrl . '/getMakul');
        
        $makulData = [];
        if ($response->successful()) {
            $makulData = $response->json('data') ?? []; 
        }
        
        return view('master_tutorial.edit', compact('tutorial', 'makulData'));
    }
    
    public function update(Request $request, $id)
    {
        $master = MasterTutorial::findOrFail($id);
    
        $master->update([
            'judul' => $request->judul,
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
            'url_presentation' => $request->url_presentation,
            'url_finished' => $request->url_finished,
            'creator_email' => $request->creator_email,
        ]);

        return back()->with('success', 'Tutorial berhasil diubah!');
    }

    public function destroy($id)
    {
        $master = MasterTutorial::findOrFail($id);
        $master->delete();
        
        return back()->with('success', 'Tutorial berhasil dihapus!');
    }

}
