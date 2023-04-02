@extends('layouts.admin.master')

@section('title')
    Hasil Penilaian
@endsection

@push('add-style')
    <style>
        table th {
            color: white;
        }
    </style>
@endpush

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Hasil Penilaian</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Kriteria</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th>No</th>
                                        <th scope="col">Nama Kriteria</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $key => $value)
                                        <tr>
                                            <td width="5%">{{ $value->kode }}</td>
                                            <td width="50%">{{ $value->nama_kriteria }}</td>
                                            <td width="15%">{{ $value->jenis }}</td>
                                            <td width="15%">{{ $value->bobot }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Alternatif</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th>No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nik</th>
                                        <th scope="col">Jenis Pekerjaan</th>
                                        <th scope="col">Unit Kerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laskar as $key => $value)
                                        <tr>
                                            <td>{{ $value->kode }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->nik }}</td>
                                            <td>{{ $value->jenis_pekerjaan }}</td>
                                            <td>{{ $value->unit_kerja }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Alternatif Kriteria</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Laskar</th>
                                        <th colspan="{{ $kriteria->count() }}" style="text-align:center;">Kriteria</th>
                                    </tr>
                                    <tr>
                                        @foreach ($kriteria as $value)
                                            <th>{{ $value->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
