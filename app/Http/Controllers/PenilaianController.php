<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Nilai;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\LaskarPelangi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;

class PenilaianController extends Controller
{

    public function index(){
        $laskar = LaskarPelangi::orderBy('nama','asc')->get();
        $laskar_nilai = LaskarPelangi::where('penilaian','false')->orderBy('nama','asc')->get();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.index',compact('laskar','kriteria','laskar_nilai'));
    }

    public function getNilai($id){
        $nilai = Nilai::select('nilai')->where('laskar_pelangi_id',$id)->get();
        $data = [];
        foreach($nilai as $value){
            $data[] = $value->nilai;
        }
        return response()->json($data);
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
        $laskar->save();
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
    }

    public function rekap(){
        $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.rekap',compact('laskar','kriteria'));
    }

    public function rekomendasi(){
        $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        return view('admin.penilaian.rekomendasi',compact('laskar','kriteria'));
    }

    public function printLayak(){
        $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        $pdf = PDF::loadview('admin.penilaian.print_layak',compact('laskar','kriteria'))->setPaper('a4','landscape');
        return $pdf->stream();
    }


    public function printTlayak(){
        $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        $pdf = PDF::loadview('admin.penilaian.print_tlayak',compact('laskar','kriteria'))->setPaper('a4','landscape');
        return $pdf->stream();
    }

    public function print(){
        $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        $pdf = PDF::loadview('admin.penilaian.print',compact('laskar','kriteria'))->setPaper('a4','landscape');
        return $pdf->stream();
    }

}
