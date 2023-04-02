<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use App\Models\LaskarPelangi;

class LaskarPelangiController extends Controller
{
    public function index(){
        $data = LaskarPelangi::all();
        return view('admin.laskar.index',compact('data'));
    }

    public function create(){
        return view('admin.laskar.create');
    }

    public function store(Request $request){
        $request->validate([
            'kode' => 'unique:laskar_pelangis',
            'nama' => 'required',
            'nik' => 'required',
            'jenis_pekerjaan' => 'required',
            'unit_kerja' => 'required'
        ]);

        $data = new LaskarPelangi();
        $data->kode = $request->kode;
        $data->nama = $request->nama;
        $data->nik = $request->nik;
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->unit_kerja = $request->unit_kerja;
        $data->save();
        Alert::success('Berhasil', 'Berhasil Menambah Data');
        return redirect()->route('laskar.index');
    }

    public function edit($id){
        $data = LaskarPelangi::findOrFail($id);
        return view('admin.laskar.edit',compact('data'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'kode' => 'unique:laskar_pelangis,kode,'.$id,
            'nama' => 'required',
            'nik' => 'required',
            'jenis_pekerjaan' => 'required',
            'unit_kerja' => 'required'
        ]);
        $data = LaskarPelangi::findOrFail($id);
        $data->kode = $request->kode;
        $data->nama = $request->nama;
        $data->nik = $request->nik;
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->unit_kerja = $request->unit_kerja;
        $data->save();
        Alert::success('Berhasil', 'Berhasil Mengubah Data');
        return redirect()->route('laskar.index');
    }

    public function destroy(Request $request){
        $data = LaskarPelangi::findOrFail($request->id);
        $data->delete();
        Alert::success('Berhasil', 'Berhasil Menghapus Data');
        return redirect()->route('laskar.index');
    }

}
