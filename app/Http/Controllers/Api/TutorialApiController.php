<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterTutorial;
use Illuminate\Http\Request;

class TutorialApiController extends Controller
{
    public function getByMakul($kode_matkul)
    {
        $tutorials = MasterTutorial::where('kode_mata_kuliah', $kode_matkul)
            ->select('judul', 'url_presentation', 'url_finished', 'creator_email','created_at', 'updated_at')
            ->get();

        if ($tutorials->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'description' => "Not Found data {$kode_matkul}"
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'description' => 'OK',
            'result' => $tutorials
        ], 200);

    }
}
