<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Penilaian</title>
    <style>
        .head {
            text-align: center;
        }

        h3 {
            line-height: 0px;
        }

        th {
            font-size: 15px;
        }

        td {
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="head">
        <h3>Penilaian Kinerja </h3>
        <h3>Tahun {{ date('Y') }}</h3>
        <h3>Pengendalian Penduduk Dan Keluarga Berencana Kota Makassar</h3>
    </div>
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
                        $hasil_rank['id'] = $value_l->id;
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
    <table border="1" cellpadding="5" cellspacing="0" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th scope="col">Nama </th>
                <th scope="col">Nik </th>
                <th scope="col">Jenis Pekerjaan </th>
                <th scope="col">Unit Kerja </th>
                @foreach ($kriteria as $value)
                    <th style="text-align:center">{{ $value->kode }}</th>
                @endforeach
                <th scope="col">Nilai Akhir</th>
                <th scope="col">Nilai Rata - rata</th>
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
                    @php
                        $nilais = App\Models\Nilai::where('laskar_pelangi_id', $value['id'])->get();
                        $sum = App\Models\Nilai::where('laskar_pelangi_id', $value['id'])->sum('nilai');
                        $count = count($nilais);
                        $average = $sum == 0 ? 0 : $sum / $count;
                    @endphp
                    {{-- @foreach ($nilais as $item)
                        <td>{{ $item->nilai }}</td>
                    @endforeach --}}
                    @foreach ($kriteria as $key => $val)
                        @php
                            $nilai = empty($nilais[$key]) ? 0 : $nilais[$key]['nilai'];
                        @endphp
                        <td>{{ $nilai }}</td>
                    @endforeach
                    <td>{{ number_format($value['nilai'], 5) }}</td>
                    <td>{{ number_format($average, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <strong>Keterangan :</strong>
    <table>
        @foreach ($kriteria as $key => $val)
            <tr>
                <td><strong>{{ $val->kode }} :</strong></td>
                <td>{{ $val->nama_kriteria }}</td>
                <td>({{ $val->bobot }})</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
