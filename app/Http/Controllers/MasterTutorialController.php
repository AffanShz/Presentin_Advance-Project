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

    public function create(){
        $token = Session::get('refreshToken');

        $response = Http::withToken($token)
                ->get('https://jwt-auth-eight-neon.vercel.app/getMakul');
        
        $matakuliah = [];

        if ($response->successful()) {
            $mataKuliah = $response->json('data'); 
        }
        
        return view('master_tutorial.create', compact('matakuliah'));
    }

    public function store(Request $request){
        $judul = $request->input('judul');

        $slug= Str::slug($judul);

        $randomPres = rand(11111111,99999999);
        $randomFin = rand(11111111,99999999);

        MasterTutorial::create([
            'judul'=> $judul,
            'kode_mata_kuliah' => $request->input('kode_mata_kuliah'),
            'url_presentation' => url("/presentation/".$slug."/".$randomPres),
            'url_finished' => url("/presentation/".$slug."/".$randomFin),
            'creator_email' => $request->input('creator_email'),
        ]);

        return redirect('/master-tutorial')->with('success', 'Tutorial berhasil ditambahkan');
    }

}
