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
                        @include('sweetalert::alert')
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('penilaian.store') }}" method="POST" id="form-nilai">
                                    @csrf
                                    <table width="100%" class="table table-bordered">
                                        <tr>
                                            <td colspan="2"><b>Nama :</b></td>
                                            <td>
                                                <select name="laskar_id" class="js-example-basic-single" style="width:100%"
                                                    id="laskar_id">
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
                                                        placeholder="0 - 100" value="">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        var SITEURL = "{{ URL('/') }}";
        $(function() {
            $(document).ready(function() {
                $('form').ajaxForm({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        var form = $('form');
                        form.find('small').remove();
                        form.find('.form-group').removeClass('is-invalid');
                        form.find('.form-control').removeClass('is-invalid');
                    },
                    success: function(xhr) {
                        $('#form-nilai').trigger("reset");
                        $('#laskar_id').val('').trigger('change');
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil Menambah Penilaian!',
                        })
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Lengkapi Form Terlebih Dahulu!',
                        })
                        var res = $.parseJSON(xhr.responseText);
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function(key, value) {
                                $('#' + key).closest('.form-group').addClass(
                                    'is-invalid mb-1').append(
                                    '<small class="is-invalid text-danger">' +
                                    '<strong class="mb-0">' + value + '</strong>' +
                                    '</small>');
                                $('#' + key).closest('.form-control').addClass(
                                    'is-invalid');
                            })
                        }
                    }
                });
            });
        });
    </script>
@endpush