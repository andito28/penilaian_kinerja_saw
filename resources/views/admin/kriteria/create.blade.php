@extends('layouts.admin.master')

@section('title')
    Kriteria | Tambah
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header" style="margin-top: 20px">
                            <h4>Tambah Kriteria</h4>
                        </div>
                        <div class="QA_table mb_30">
                            <form method="POST" action="{{ route('kriteria.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Kode</label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            name="kode" value="{{ old('kode') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Nama Kriteria</label>
                                        <input type="text"
                                            class="form-control @error('nama_kriteria') is-invalid @enderror"
                                            name="nama_kriteria" value="{{ old('nama_kriteria') }}">
                                    </div>
                                    <div class=" col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Jenis</label>
                                        <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                            <option value="">Pilih</option>
                                            <option value="benefit">Benefit</option>
                                            <option value="cost">Cost</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-weight:600">Bobot</label>
                                        <input type="number" class="form-control @error('bobot') is-invalid @enderror"
                                            name="bobot" step="any" value="{{ old('bobot') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Kriteria</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
