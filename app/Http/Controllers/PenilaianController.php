<?php

namespace App\Http\Controllers;

use Alert;
use Carbon\Carbon;
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
        $currentYear = Carbon::now()->year;
        $nilai = Nilai::select('nilai')->where('laskar_pelangi_id',$id)->whereYear('created_at', $currentYear)->get();
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
        $currentYear = Carbon::now()->year;
        $request->validate([
            'laskar_id' => 'required',
            'nilai.*' => 'required|max:100'
        ]);
        $laskar = LaskarPelangi::findOrFail($request->laskar_id);
        $laskar->penilaian = "true";
        $laskar->save();
        $count = count($request->nilai);
        $data = Nilai::where('laskar_pelangi_id',$request->laskar_id)->whereYear('created_at',$currentYear)->first();
        if($data){
            $count = count($request->kriteria);
            for ($i = 0; $i < $count; $i++) {
                $criteria = $request->kriteria[$i];
                Nilai::updateOrInsert(
                    [
                        'laskar_pelangi_id' => $request->laskar_id,
                        'kriteria_id' => $criteria,
                    ],
                    [
                        'nilai' => $request->nilai[$i],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
            }

            // for($i=0;  $i < $count; $i++){
            //     Nilai::where(['laskar_pelangi_id' => $request->laskar_id])
            //     ->where(['kriteria_id' => $request->kriteria[$i]])
            //     ->update(['nilai' => $request->nilai[$i]]);
            // }
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

    public function printLayak(Request $request){
        // $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $tahun = $request->tahun;
        $laskar = LaskarPelangi::whereYear('created_at',$tahun)->orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        $pdf = PDF::loadview('admin.penilaian.print_layak',compact('laskar','kriteria','tahun'))->setPaper('a4','landscape');
        return $pdf->stream();
    }


    public function printTlayak(Request $request){
        // $laskar = LaskarPelangi::orderBy('kode','asc')->get();
        $tahun = $request->tahun;
        $laskar = LaskarPelangi::whereYear('created_at',$tahun)->orderBy('kode','asc')->get();
        $kriteria = Kriteria::all();
        $pdf = PDF::loadview('admin.penilaian.print_tlayak',compact('laskar','kriteria','tahun'))->setPaper('a4','landscape');
        return $pdf->stream();
    }

    public function print(Request $request){
        $tahun = $request->tahun;
        $laskar_id = $request->laskar_id;
        if($laskar_id != 'all'){
            $laskar = LaskarPelangi::where('id',$laskar_id)->whereYear('created_at',$tahun)->orderBy('kode','asc')->get();
        }else{
            $laskar = LaskarPelangi::whereYear('created_at',$tahun)->orderBy('kode','asc')->get();
        }
        $kriteria = Kriteria::all();
        $pdf = PDF::loadview('admin.penilaian.print',compact('laskar','kriteria','tahun'))->setPaper('a4','landscape');
        return $pdf->stream();
    }

}
