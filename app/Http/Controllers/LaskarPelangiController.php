<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LaskarPelangi;

class LaskarPelangiController extends Controller
{
    public function index(){
        $data = LaskarPelangi::orderBy('kode','asc')->get();
        return view('admin.laskar.index',compact('data'));
    }

    public function create(){
        $data = LaskarPelangi::max('kode');
        $order = (int) substr($data, 3, 3);
        $order++;
        $name = "LSK";
        $kode = $name . sprintf("%03s", $order);
        return view('admin.laskar.create',compact('kode'));
    }

    public function store(Request $request){
        $request->validate([
            'kode' => 'unique:laskar_pelangis',
            'nama' => 'required',
            'nik' => 'required:unique:laskar_pelangis',
            'jenis_pekerjaan' => 'required',
            'unit_kerja' => 'required'
        ]);

        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->nik;
        $user->password = bcrypt('12345678');
        $user->role = 'laskar';
        $user->save();

        $data = new LaskarPelangi();
        $data->user_id = $user->id;
        $data->kode = $request->kode;
        $data->nama = $request->nama;
        $data->nik = $request->nik;
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->unit_kerja = $request->unit_kerja;
        $data->penilaian = "false";
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
            'nik' =>  'required,unique:laskar_pelangis,kode,'.$id,
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
