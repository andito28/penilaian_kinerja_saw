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
        }
    </style>
@endpush

@section('content')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            @include('sweetalert::alert')
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="f_s_30 f_w_700 text_white">Data Laskar Pelangi</h3>
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
                                                <th scope="col">Email</th>
                                                <th scope="col">Pesan</th>
                                                <th scope="col">Tanggal</th>
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
        </div>
    </div>
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
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
@endsection

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
