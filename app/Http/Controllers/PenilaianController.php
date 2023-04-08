<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Nilai;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\LaskarPelangi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'laskar_id' => 'required',
            'nilai.*' => 'required|max:100'
        ]);
        $laskar = LaskarPelangi::findOrFail($request->laskar_id);
        $laskar->penilaian = "true";
        $laskar-save();
        $count = count($request->nilai);
        $data = Nilai::where('laskar_pelangi_id',$request->laskar_id)->first();
        if($data){
            for($i=0;  $i < $count; $i++){
                Nilai::where(['laskar_pelangi_id' => $request->laskar_id])
                ->where(['kriteria_id' => $request->kriteria[$i]])
                ->update(['nilai' => $request->nilai[$i]]);
            }
        }else{
            for($i=0;  $i < $count; $i++){
                Nilai::create([
                    'laskar_pelangi_id' => $request->laskar_id,
                    'kriteria_id' => $request->kriteria[$i],
                    'nilai' => $request->nilai[$i]
                ]);
            }
        }
        // Alert::success('Berhasil', 'Berhasil Menambah Penilaian');
        // return redirect()->route();
    }


}
