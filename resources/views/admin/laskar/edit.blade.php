@extends('layouts.admin.master')

@section('title')
    Laskar Pelangi | Edit
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header" style="margin-top: 20px">
                            <h4>Edit Laskar Pelangi</h4>
                        </div>
                        <div class="QA_table mb_30">
                            <form method="POST" action="{{ route('laskar.update', $data->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Kode</label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            name="kode" value="{{ old('kode', $data->kode) }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama', $data->nama) }}">
                                        @error('nama')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">NIK</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ old('nik', $data->nik) }}">
                                        @error('nik')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" style="font-weight:600">Jenis Pekerjaan</label>
                                        <input type="text"
                                            class="form-control @error('jenis_pekerjaan') is-invalid @enderror"
                                            name="jenis_pekerjaan"
                                            value="{{ old('jenis_pekerjaan', $data->jenis_pekerjaan) }}">
                                        @error('jenis_pekerjaan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" style="font-weight:600">Unit Kerja</label>
                                        <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror"
                                            name="unit_kerja" value="{{ old('unit_kerja', $data->unit_kerja) }}" readonly>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Laskar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
