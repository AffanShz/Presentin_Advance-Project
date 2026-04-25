<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTutorial;

class DetailTutorialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'master_tutorial_id' => 'required',
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images', 'public');
        }

        DetailTutorial::create([
            'master_tutorial_id' => $request->input('master_tutorial_id'),
            'text' => $request->input('text'),
            'gambar' => $imagePath,
            'code' => $request->input('code'),
            'url' => $request->input('url'),
            'order' => $request->input('order'),
            'status' => $request->input('status'),
        ]);

        return back()->with('success', 'Detail tutorial berhasil ditambahkan!');
    }
}
