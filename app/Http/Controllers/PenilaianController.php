<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\LaskarPelangi;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function hasil(){
        $nilai = Nilai::all();
        $laskar = LaskarPelangi::all();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.hasil',compact('laskar','kriteria'));
    }


}
