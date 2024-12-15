<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PublicServiceController extends Controller
{
    public function index ()  {
        return view('main.page.persuratan');
    }

    public function findNik () {
        $findPenduduk = Penduduk::where('nik', request()->data)->first();
        return response()->json(['data' => $findPenduduk]);
    }

    public function generatePDF () {
        $data = request()->all();
        $data['gambar'] = asset("assets/img/malang.png");
        $pdf = Pdf::loadView('main.layouts.pdf_template', compact('data'));

        return $pdf->stream('laporan.pdf');
    }
}
