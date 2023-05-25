@extends('layouts.admin.master')

@section('title', 'Penilaian')

@push('add-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            padding-top: 5px;
            height: 40px;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: whitesmoke;
            color: black;
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
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
                        @include('sweetalert::alert')
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <form action="{{ route('penilaian.store') }}" method="POST" id="form-nilai">
                                    @csrf
                                    <table width="100%" class="table table-bordered">
                                        <tr>
                                            <td colspan="3">
                                                <b>NAMA LASKAR PELANGI : </b>
                                                <select name="laskar_id" class="js-example-basic-single" style="width:70%"
                                                    id="laskar_id">
                                                    <option value="0">PILIH . . . . .</option>
                                                    @foreach ($laskar as $value)
                                                        <option data-id="{{ $value->penilaian }}"
                                                            value="{{ $value->id }}">
                                                            {{ $value->nama }} <i
                                                                class="fa fa-check-circle custom-icon"></i></option>
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
                                                    <input type="number" class="form-control data-input" name="nilai[]"
                                                        placeholder="0 - 100" value="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <button class="btn btn-primary">Submit Penilaian</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <table border="2" class="table table-bordered">
                                <tr>
                                    <td><b>Kategori Penilaian</b></td>
                                    <td><b>Nilai Rata - rata</b></td>
                                </tr>
                                <tr>
                                    <td><b>Baik</b></td>
                                    <td><b>81 - 100</b></b></td>
                                </tr>
                                <tr>
                                    <td><b>Sedang</b></td>
                                    <td><b>71 - 80</b></b></td>
                                </tr>
                                <tr>
                                    <td><b>Buruk</b></td>
                                    <td><b>0 - 70</b></b></td>
                                </tr>
                            </table>
                            <table class="table table-bordered" border="2">
                                <tr>
                                    <th>Daftar yang belum di nilai</th>
                                    <th style="text-align: center">
                                        <a href="">
                                            <i class="fa fa-refresh fa-lg"></i>
                                        </a>
                                    </th>
                                </tr>
                                @forelse ($laskar_nilai as $key => $value)
                                    <tr>
                                        <td colspan="2"> <i class='fa fa-dot-circle-o'></i> {{ $value->nama }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="text-align:center">
                                            <span class="text-success">
                                                <strong>Semua Sudah Dinilai</strong>
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
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
        var waktuTimeout = 2000;
        // Fungsi untuk me-reload halaman
        function reloadHalaman() {
            location.reload();
        }
        var SITEURL = "{{ URL('/') }}";
        $(function() {
            $(document).ready(function() {
                $('#form-nilai').ajaxForm({
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
                        setTimeout(reloadHalaman, waktuTimeout);
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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                templateResult: function(option) {
                    var color;
                    if (option.element && option.element.dataset.id === 'true') {
                        color = '#00a000'; // Warna latar belakang untuk nilai 1
                    } else if (option.element && option.element.dataset.id === 'false') {
                        color = '#ff0000'; // Warna latar belakang untuk nilai 2
                    }
                    return $('<span style="color:' + color + ';font-weight:500">' + option.text +
                        '</span>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#laskar_id').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: '{{ route('nilai', ':id') }}'.replace(':id', id),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('.data-input').each(function(index) {
                                var value = data[index] || '';
                                $(this).val(value);
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
