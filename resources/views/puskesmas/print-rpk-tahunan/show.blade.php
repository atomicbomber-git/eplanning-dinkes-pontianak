@extends("layouts.print")

@section("heads")
    <style>
        h1 {
            text-align: center;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border: thin solid black;
            border-collapse: collapse;
        }

        td, th {
            border: thin solid black;
        }
    </style>
@endsection

@section("content")
    <h1> Rencana Pelaksanaan Tahunan Puskesmas {{ $rpk_tahunan->puskesmas->nama  }} Tahun {{ $rpk_tahunan->tahun  }} </h1>

    <table>
        <thead>
        <tr>
            <th> No </th>
            <th> Upaya Kesehatan</th>
            <th> Kegiatan</th>
            <th> Tujuan</th>
            <th> Sasaran</th>
            <th> Target Sasaran</th>
            <th> Penanggung Jawab</th>
            <th> Volume Kegiatan</th>
            <th> Jadwal</th>
            <th> Rincian Pelaksanaan</th>
            <th> Lokasi Pelaksanaan</th>
            <th> Biaya</th>
        </tr>
        </thead>

        <tbody>
            @foreach($unit_puskesmas_list AS $unit_puskesmas)
                <tr>
                    <td colspan="12">
                        {{ $unit_puskesmas->nama }}
                    </td>
                </tr>

                @php
                    $count = 0
                @endphp

                @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                    @foreach($upaya_kesehatan->item_rencana_pelaksanaan_kegiatan_tahunan_list AS $item)
                        <tr>
                            <td> {{ ++$count }} </td>
                            <td> {{ $upaya_kesehatan->nama  }}  </td>
                            <td> {{ $item->kegiatan }} </td>
                            <td> {{ $item->tujuan }} </td>
                            <td> {{ $item->sasaran }} </td>
                            <td> {{ $item->target_sasaran }} </td>
                            <td> {{ $item->penanggung_jawab }} </td>
                            <td> {{ $item->volume_kegiatan }} </td>
                            <td> {{ $item->jadwal }} </td>
                            <td> {{ $item->rincian_pelaksanaan }} </td>
                            <td> {{ $item->lokasi_pelaksanaan }} </td>
                            <td style="text-align: right"> {{ \App\Support\Formatter::currency($item->biaya) }} </td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="11" style="font-weight: bold; text-align: right">
                    Total Biaya
                </td>
                <td style="text-align: right">
                    {{ \App\Support\Formatter::currency($biaya_sum) }}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
