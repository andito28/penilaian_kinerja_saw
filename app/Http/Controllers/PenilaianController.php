<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\LaskarPelangi;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{

    public function index(){
        $laskar = LaskarPelangi::orderBy('nama','asc')->get();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.index',compact('laskar','kriteria'));
    }
    public function hasil(){
        $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.hasil',compact('laskar','kriteria'));
    }

    public function store(Request $request ){
        $count = count($request->nilai);
        $data = Nilai::where('laskar_pelangi_id',$request->laskar_id)->first();
        if($data){
            for($i=0;  $i < $count; $i++){
                Nilai::where(['laskar_pelangi_id' => $request->laskar_id])
                ->where(['kriteria_id' => $request->kriteria[$i]])
                ->update(['nilai' => $request->nilai[$i]]);
            }
        }
        return redirect()->back();
    }


}
