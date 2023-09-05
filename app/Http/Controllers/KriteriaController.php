<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index(){
        $kriteria_regulasi = Kriteria::where('tipe','regulasi')->get();
        $kriteria_tambahan = Kriteria::where('tipe','tambahan')->get();
        return view('admin.kriteria.index',compact('kriteria_regulasi','kriteria_tambahan'));
    }

    public function create(Request $request){
        $jenis_kriteria = $request->jenis;
        return view('admin.kriteria.create',compact('jenis_kriteria'));
    }

    public function store(Request $request){
        $request->validate([
            'kode' => 'unique:kriterias',
            'nama_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required'
        ]);

        $data = new Kriteria();
        $data->kode = $request->kode;
        $data->nama_kriteria = $request->nama_kriteria;
        $data->jenis = $request->jenis;
        $data->bobot = $request->bobot;
        $data->tipe = $request->jenis_kriteria;
        $data->save();
        Alert::success('Berhasil', 'Berhasil Menambah Data');
        return redirect()->route('kriteria.index');
    }

    public function edit($id){
        $data = Kriteria::findOrFail($id);
        return view('admin.kriteria.edit',compact('data'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'kode' => 'unique:kriterias,kode,'.$id,
            'nama_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required'
        ]);
        $data = Kriteria::findOrFail($id);
        $data->kode = $request->kode;
        $data->nama_kriteria = $request->nama_kriteria;
        $data->jenis = $request->jenis;
        $data->bobot = $request->bobot;
        $data->save();

        Alert::success('Berhasil', 'Berhasil Mengubah Data');
        return redirect()->route('kriteria.index');
    }

    public function destroy(Request $request){
        $data = Kriteria::findOrFail($request->id);
        $data->delete();
        Alert::success('Berhasil', 'Berhasil Menghapus Data');
        return redirect()->route('kriteria.index');
    }
}
