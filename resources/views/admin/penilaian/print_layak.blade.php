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
            line-height: 5px;
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
        <h3>Pengendalian Penduduk Dan Keluarga Berencana Kota Makassar</h3>
        <br>
    </div>

    <div class="period">
        <table style="width:100%">
            <tr>
                <td style=" text-align: right;">
                    <h3>Periode 1 Januari - 31 Desember Tahun {{ $tahun }}</h3>
                </td>
            </tr>
        </table>
    </div>
    @php
        $hasil_ranks = [];
    @endphp
    @foreach ($laskar as $value_l)
        @php
            $hasil_normalisasi = 0;
        @endphp
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
                @else
                    @php
                        $nilai_max = App\Models\Nilai::where('kriteria_id', $value_n->kriteria_id)->max('nilai');
                    @endphp
                    @php
                        $hasil = $value_n->nilai / $nilai_max;
                        $hasil_kali = $hasil * $item->bobot;
                        $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                    @endphp
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
    @endforeach
    <div class="table-penilaian">
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
                @forelse ($hasil_ranks as $value)
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
                            @foreach ($kriteria as $key => $val)
                                @php
                                    $nilai = empty($nilais[$key]) ? 0 : $nilais[$key]['nilai'];
                                @endphp
                                <td>{{ $nilai }}</td>
                            @endforeach
                            <td>{{ number_format($value['nilai'], 5) }}</td>
                            <td>{{ number_format($average, 2) }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="21">
                            <h3>Tidak ada data</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>
        <strong>Catatan : Berdasarkan hasil penilaian maka rekomendasi keputusan nilai dari 81- 100 Layak diperpanjang
            dan
            nilai 71 - 80 layak diperpanjang namun evaluasi selama 3 bulan</strong>
        <div class="period" style="float:right;margin-top:160px;margin-right:160px;">
            <p>Diketahui oleh,</p>
            <p>Kepala Dinas</p>
            <div class="ttd" style="margin:50px;">

            </div>
            <p>Syahruddin, S.Sos, M.Adm. Pemb</p>
        </div>
    </div>
</body>

</html>
