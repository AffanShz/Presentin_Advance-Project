<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterTutorial;
use Barryvdh\DomPDF\Facade\Pdf;

class PublicTutorialController extends Controller
{
    public function presentation($slug) {
        $master = MasterTutorial::where('url_presentation', 'like', "%/presentation/{$slug}")->firstOrFail();

        $details = $master->details()->where('status', 'show')->orderBy('order')->get();
        
        return view('public.presentation', compact('master','details'));
    }

    public function finished($slug)
    {
        $master = MasterTutorial::where('url_finished', 'like', "%/finished/{$slug}")->firstOrFail();

        $details = $master->details()->orderBy('order')->get();

        $pdf = Pdf::loadView('public.finished_pdf', compact('master', 'details'));

        return $pdf->stream("tutorial-lengkap.pdf");
        
    }
}
