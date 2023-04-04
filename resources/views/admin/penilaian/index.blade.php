@extends('layouts.admin.master')

@section('title', 'Penilaian')

@push('add-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            padding-top: 5px;
            height: 40px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Penilaian</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body">
                    <div class="row pt-2">
                        <div class="col-md-4 mb-2">
                            <table border="2" class="table table-bordered">
                                <tr>
                                    <td><b>Kategori Penilaian</b></td>
                                    <td><b>Nilai Rata - rata</b></td>
                                </tr>
                                <tr>
                                    <td><b>Baik</b></td>
                                    <td><b>81 - 100</b></b></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4 mb-2">
                            <table border="2" class="table table-bordered">
                                <tr>
                                    <td><b>Kategori Penilaian</b></td>
                                    <td><b>Nilai Rata - rata</b></td>
                                </tr>
                                <tr>
                                    <td><b>Sedang</b></td>
                                    <td><b>71 - 80</b></b></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4 mb-2">
                            <table border="2" class="table table-bordered">
                                <tr>
                                    <td><b>Kategori Penilaian</b></td>
                                    <td><b>Nilai Rata - rata</b></td>
                                </tr>
                                <tr>
                                    <td><b>Buruk</b></td>
                                    <td><b>0 - 70</b></b></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('penilaian.store') }}" method="POST">
                                    @csrf
                                    <table width="100%" class="table table-bordered">
                                        <tr>
                                            <td colspan="2"><b>Nama :</b></td>
                                            <td>
                                                <select name="laskar_id" class="js-example-basic-single" style="width:100%">
                                                    <option value="">PILIH . . . . .</option>
                                                    @foreach ($laskar as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        @foreach ($kriteria as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <input type="hidden" name="kriteria[]" value="{{ $value->id }}">
                                                    {{ $value->nama_kriteria }}
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="nilai[]"
                                                        placeholder="0 - 100">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <button class="btn btn-primary">Submit Penilaian</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
