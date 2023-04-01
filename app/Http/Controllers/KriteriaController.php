<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index(){
        $data = Kriteria::all();
        return view('admin.kriteria.index',compact('data'));
    }

    public function create(){
        return view('admin.kriteria.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required'
        ]);

        $data = new Kriteria();
        $data->nama_kriteria = $request->nama_kriteria;
        $data->jenis = $request->jenis;
        $data->bobot = $request->bobot;
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
            'nama_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required'
        ]);

        $data = Kriteria::findOrFail($id);
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
