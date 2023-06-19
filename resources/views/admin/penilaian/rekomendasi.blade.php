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
                    <h3 class="f_s_30 f_w_700 text_white">Rekomendasi Keputusan</h3>
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
                            <h4 class="pt-2">Rekomendasi Keputusan Layak Diperpanjang
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <div class="float-end">
                                <a href="{{ route('print.layak') }}" target="_blank" class="btn btn-primary mt-2">
                                    <i class='fa fa-print fa-lg'></i> Rekap
                                </a>
                            </div>
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
                                                $hasil_rank['id'] = $value_l->id;
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
                                        @php
                                            $nilais = App\Models\Nilai::where('laskar_pelangi_id', $value['id'])->get();
                                            $sum = App\Models\Nilai::where('laskar_pelangi_id', $value['id'])->sum('nilai');
                                            $count = count($nilais);
                                            $average = $sum == 0 ? 0 : $sum / $count;
                                        @endphp

                                        @if ($average > 70)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value['nama'] }}</td>
                                                <td>{{ $value['nik'] }}</td>
                                                <td>{{ $value['jenis_pekerjaan'] }}</td>
                                                <td>{{ $value['unit_kerja'] }}</td>
                                                <td>{{ number_format($average, 2) }}</td>
                                            </tr>
                                        @endif
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
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="pt-2">Rekomendasi Keputusan Tidak Layak Diperpanjang
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end">
                                <a href="{{ route('print.tlayak') }}" target="_blank" class="btn btn-primary mt-2">
                                    <i class='fa fa-print fa-lg'></i> Rekap
                                </a>
                            </div>
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
                                                $hasil_rank['id'] = $value_l->id;
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
                                        @php
                                            $nilais = App\Models\Nilai::where('laskar_pelangi_id', $value['id'])->get();
                                            $sum = App\Models\Nilai::where('laskar_pelangi_id', $value['id'])->sum('nilai');
                                            $count = count($nilais);
                                            $average = $sum == 0 ? 0 : $sum / $count;
                                        @endphp

                                        @if ($average <= 70)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value['nama'] }}</td>
                                                <td>{{ $value['nik'] }}</td>
                                                <td>{{ $value['jenis_pekerjaan'] }}</td>
                                                <td>{{ $value['unit_kerja'] }}</td>
                                                <td>{{ number_format($average, 2) }}</td>
                                            </tr>
                                        @endif
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
    <script>
        function bukaTab(url) {
            window.open(url, '_blank');
        }
    </script>
@endpush
