@extends('layouts.admin.master')

@section('title')
    Laskar Pelangi | Tambah
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header" style="margin-top: 20px">
                            <h4>Tambah Laskar Pelangi</h4>
                        </div>
                        <div class="QA_table mb_30">
                            <form method="POST" action="{{ route('laskar.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Kode</label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            name="kode" value="{{ $kode }}" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama') }}">
                                    </div>
                                    <div class=" col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">NIK</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ old('nik') }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Jenis Pekerjaan</label>
                                        <input type="text"
                                            class="form-control @error('jenis_pekerjaan') is-invalid @enderror"
                                            name="jenis_pekerjaan" value="{{ old('jenis_pekerjaan') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-weight:600">Unit Kerja</label>
                                        <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror"
                                            name="unit_kerja" value="{{ old('unit_kerja') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Laskar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
