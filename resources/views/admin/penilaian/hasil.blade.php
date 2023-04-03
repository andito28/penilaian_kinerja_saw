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

        {{-- bagian kriteria --}}
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

        {{-- bagian alternatif --}}
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

        {{-- bagian alternatif kriteria --}}
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Alternatif Kriteria</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Alternatif
                                        </th>
                                        <th colspan="{{ $kriteria->count() }}" style="text-align:center;">Kriteria</th>
                                    </tr>
                                    <tr>
                                        @foreach ($kriteria as $value)
                                            <th style="text-align:center">{{ $value->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @foreach ($laskar as $value)
                                        <tr>
                                            <td>{{ $value->kode }}</td>
                                            @php
                                                $nilai = App\Models\Nilai::where('laskar_pelangi_id', $value->id)->get();
                                            @endphp
                                            @foreach ($nilai as $value)
                                                <td>{{ $value->nilai }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- bagian Normalisasi --}}
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Normalisasi</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Alternatif
                                        </th>
                                        <th colspan="{{ $kriteria->count() }}" style="text-align:center;">Kriteria</th>
                                    </tr>
                                    <tr>
                                        @foreach ($kriteria as $value)
                                            <th style="text-align:center">{{ $value->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @foreach ($laskar as $value_l)
                                        @php
                                            $hasil_normalisasi = 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $value_l->kode }}</td>
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
                                                        @endphp
                                                        <td>{{ number_format($hasil = $nilai_min / $value_n->nilai, 2) }}
                                                        </td>
                                                        @php
                                                            $hasil_kali = $hasil * $item->bobot;
                                                            $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $nilai_max = App\Models\Nilai::where('kriteria_id', $value_n->kriteria_id)->max('nilai');
                                                        @endphp
                                                        <td>{{ $hasil = $value_n->nilai / $nilai_max }}
                                                        </td>
                                                        @php
                                                            $hasil_kali = $hasil * $item->bobot;
                                                            $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- bagian pembobotan --}}
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Pembobotan</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead style="background-color: #20c997; ">
                                    <tr>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Alternatif
                                        </th>
                                        <th colspan="{{ $kriteria->count() }}" style="text-align:center;">Kriteria</th>
                                        <th rowspan="2" style="vertical-align : middle;text-align:center">Hasil</th>
                                    </tr>
                                    <tr>
                                        @foreach ($kriteria as $value)
                                            <th style="text-align:center">{{ $value->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @php
                                        $hasil_ranks = [];
                                    @endphp
                                    @foreach ($laskar as $value_l)
                                        @php
                                            $hasil_normalisasi = 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $value_l->kode }}</td>
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
                                                        <td>{{ $hasil_kali }}
                                                        </td>
                                                    @else
                                                        @php
                                                            $nilai_max = App\Models\Nilai::where('kriteria_id', $value_n->kriteria_id)->max('nilai');
                                                        @endphp
                                                        @php
                                                            $hasil = $value_n->nilai / $nilai_max;
                                                            $hasil_kali = $hasil * $item->bobot;
                                                            $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                                        @endphp
                                                        <td>{{ $hasil_kali }}
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <td>
                                                @php
                                                    $hasil_rank['nilai'] = $hasil_normalisasi;
                                                    $hasil_rank['nama'] = $value_l->nama;
                                                    $hasil_rank['nik'] = $value_l->nik;
                                                    $hasil_rank['jenis_pekerjaan'] = $value_l->jenis_pekerjaan;
                                                    $hasil_rank['unit_kerja'] = $value_l->unit_kerja;
                                                    array_push($hasil_ranks, $hasil_rank);
                                                @endphp
                                                {{ $hasil_normalisasi }}
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

        {{-- bagian perangkingan --}}
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <h4 class="pt-2">Hasil Perangkingan</h4>
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
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
                                            <td>{{ $value['nilai'] }}</td>
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
