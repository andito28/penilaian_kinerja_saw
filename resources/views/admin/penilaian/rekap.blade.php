@extends('layouts.admin.master')

@section('title')
    Rekap Penilaian
@endsection

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Rekap Penilaian</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body">
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table lms_table_active" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th>No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nik</th>
                                        <th scope="col">Jenis Pekerjaan</th>
                                        <th scope="col">Unit Kerja</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->nik }}</td>
                                            <td>{{ $value->jenis_pekerjaan }}</td>
                                            <td>{{ $value->unit_kerja }}</td>
                                            <td width="15%">
                                                <a class="btn btn-success text-white"
                                                    href="{{ route('laskar.edit', $value->id) }}"> <i
                                                        class="fa fa-pencil-alt"></i></a>
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modalTambah"
                                                    data-id='{{ $value->id }}' class="delete-data btn btn-danger"> <i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
