@extends('layouts.admin.master')

@section('title', 'Dashboard')

@push('add-style')
    <style>
        h2 {
            font-size: 30px;
            font-weight: bold;
        }

        .body {
            padding-top: 90px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('pages/img/dashboard.jpg') }}" alt="image" style="width:100%">
                        </div>
                        <div class="col-md-6">
                            <div class="body text-center">
                                <h2>
                                    Penerapan Metode SAW Untuk
                                </h2>
                                <h2>
                                    Penilaian Kinerja Laskar Pelangi
                                </h2>
                                <h2>
                                    Dinas PPKB Kota Makassar
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
