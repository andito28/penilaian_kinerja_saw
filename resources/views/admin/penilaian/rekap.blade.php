@extends('layouts.admin.master')

@section('title')
    Hasil Penilaian
@endsection

@push('add-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            margin-top: 8px;
            padding-top: 5px;
            height: 38px;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: whitesmoke;
            color: black;
        }

        table th {
            color: white;
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
@endpush

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
        {{-- bagian perangkingan --}}
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="pt-2">Rekap Hasil Penilaian</h4>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('print') }}" method="get" target="_blank">
                                <div class="row">
                                    <div class="col-md-5">
                                        <select name="laskar_id" class="js-example-basic-single mt-2" style="width:100%"
                                            id="laskar_id" required>
                                            <option value="all">tampilkan semuanya . . </option>
                                            @foreach ($laskar as $value)
                                                <option data-id="{{ $value->penilaian }}" value="{{ $value->id }}">
                                                    {{ $value->nama }} <i class="fa fa-check-circle custom-icon"></i>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control mt-2" id="tahun" name="tahun" required>
                                            @php
                                                $tahun = date('Y');
                                            @endphp
                                            <option value="">Tahun</option>
                                            @for ($i = 2022; $i <= $tahun; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        {{-- <a href="{{ route('print') }}" target="_blank" class="btn btn-primary mt-2">
                                            <i class='fa fa-print fa-lg'></i> Rekap
                                        </a> --}}
                                        <button type="submit" class="btn btn-primary mt-2"> <i
                                                class='fa fa-print fa-lg'></i> Rekap </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <tbody style="text-align:center">
                                    @php
                                        $hasil_ranks = [];
                                    @endphp
                                    @foreach ($laskar as $value_l)
                                        @php
                                            $hasil_normalisasi = 0;
                                        @endphp
                                        <tr>
                                            {{-- <td>{{ $value_l->kode }}</td> --}}
                                            @php
                                                $nilai = App\Models\Nilai::where('laskar_pelangi_id', $value_l->id)->get();
                                            @endphp
                                            @foreach ($nilai as $value_n)
                                                @php
                                                    $data_kriteria = App\Models\Kriteria::where('id', $value_n->kriteria_id)->get();
                                                @endphp
                                                @foreach ($data_kriteria as $item)
                                                    @if ($item->jenis == 'cost')
                                                        @php
                                                            $nilai_min = App\Models\Nilai::where('kriteria_id', $value_n->kriteria_id)->min('nilai');
                                                            number_format($hasil = $nilai_min / $value_n->nilai, 2);
                                                            $hasil_kali = $hasil * $item->bobot;
                                                            $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                                        @endphp
                                                        {{-- <td>{{ $hasil_kali }}
                                                        </td> --}}
                                                    @else
                                                        @php
                                                            $nilai_max = App\Models\Nilai::where('kriteria_id', $value_n->kriteria_id)->max('nilai');
                                                        @endphp
                                                        @php
                                                            $hasil = $value_n->nilai / $nilai_max;
                                                            $hasil_kali = $hasil * $item->bobot;
                                                            $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                                        @endphp
                                                        {{-- <td>{{ number_format($hasil_kali, 3) }}
                                                        </td> --}}
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            @php
                                                $hasil_rank['nilai'] = $hasil_normalisasi;
                                                $hasil_rank['nama'] = $value_l->nama;
                                                $hasil_rank['nik'] = $value_l->nik;
                                                $hasil_rank['jenis_pekerjaan'] = $value_l->jenis_pekerjaan;
                                                $hasil_rank['unit_kerja'] = $value_l->unit_kerja;
                                                array_push($hasil_ranks, $hasil_rank);
                                            @endphp
                                            {{-- <td>
                                                {{ number_format($hasil_normalisasi, 3) }}
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997;text-align:center ">
                                    <tr>
                                        <th>No</th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Nik </th>
                                        <th scope="col">Jenis Pekerjaan </th>
                                        <th scope="col">Unit Kerja </th>
                                        <th scope="col">Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @php
                                        $no = 1;
                                        rsort($hasil_ranks);
                                    @endphp
                                    @foreach ($hasil_ranks as $value)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $value['nama'] }}</td>
                                            <td>{{ $value['nik'] }}</td>
                                            <td>{{ $value['jenis_pekerjaan'] }}</td>
                                            <td>{{ $value['unit_kerja'] }}</td>
                                            <td>{{ number_format($value['nilai'], 5) }}</td>
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

@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        function bukaTab(url) {
            window.open(url, '_blank');
        }
    </script>
@endpush
