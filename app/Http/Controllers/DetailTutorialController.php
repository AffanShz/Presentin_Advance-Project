<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTutorial;
use App\Models\MasterTutorial;
use Illuminate\Support\Facades\Storage;

class DetailTutorialController extends Controller
{
    // Menampilkan daftar langkah untuk satu master tutorial tertentu
    public function show($master_id)
    {
        $master = MasterTutorial::findOrFail($master_id);
        // Urutkan berdasarkan kolom 'order' (Analogi: order by index di List)
        $details = $master->details()->orderBy('order', 'asc')->get();
        
        return view('master_tutorial.manage_details', compact('master', 'details'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'master_tutorial_id' => 'required',
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/tutorials'), $filename);
            $path = 'tutorials/' . $filename;
        }

        DetailTutorial::create([
            'master_tutorial_id' => $request->master_tutorial_id,
            'text' => $request->text,
            'code' => $request->code,
            'url' => $request->url,
            'gambar' => $path,
            'order' => $request->order,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Langkah berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:show,hide',
        ]);

        $detail = DetailTutorial::findOrFail($id);
        $detail->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status langkah berhasil diubah!');
    }

    public function destroy($id)
    {
        $detail = DetailTutorial::findOrFail($id);
        if ($detail->gambar) {
            Storage::disk('public')->delete($detail->gambar);
        }
        $detail->delete();
        return back()->with('success', 'Langkah berhasil dihapus!');
    }
}