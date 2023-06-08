@extends('layouts.admin.master')

@section('title')
    Laskar Pelangi
@endsection

@push('add-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" />
    <style>
        table.dataTable thead th {
            color: white;
            font-weight: 600;
        }

        table.dataTable tbody td {
            font-size: 14px;
            color: black;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Data Laskar Pelangi</h3>
                </div>
                <a href="{{ route('laskar.create') }}" class="white_btn3">Tambah Laskar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body">
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nik</th>
                                        <th scope="col">Jenis Pekerjaan</th>
                                        <th scope="col">Unit Kerja</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->kode }}</td>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laskar.delete') }}" method="post">
                        @csrf
                        @method('delete')
                        <div>
                            <input type=hidden id="id" name=id>
                            <h5 id="exampleModalLabel">Apakah Anda yakin ingin menghapus data ini?</h5>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('add-script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $('.delete-data').click(function() {
            var id = $(this).data('id');
            $('#id').val(id);
        });
    </script>
@endpush
