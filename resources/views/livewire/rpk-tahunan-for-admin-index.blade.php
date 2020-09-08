@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>
            Rencana Pelaksanaan Kegiatan Tahunan
        </h1>

        <x-messages></x-messages>

        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <thead class="thead thead-dark">
                    <tr>
                        <th class="text-center"> # </th>
                        <th> Puskesmas </th>
                        <th> Tahun </th>
                        <th> Waktu Pembuatan</th>
                        <th> Waktu Penerimaan</th>
                        <th class="text-right"> Total Biaya (Rp.)</th>
                        <th class="text-center"> Kendali</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rpk_tahunans as $rencana_pelaksanaan_kegiatan_tahunan)
                        <tr>
                            <td class="text-center"> {{ $rpk_tahunans->firstItem() + $loop->index }} </td>
                            <td> {{ $rencana_pelaksanaan_kegiatan_tahunan->puskesmas->nama }} </td>
                            <td> {{ $rencana_pelaksanaan_kegiatan_tahunan->tahun }} </td>
                            <td> {{ \App\Support\Formatter::fancyDatetime($rencana_pelaksanaan_kegiatan_tahunan->waktu_pembuatan)  }} </td>
                            <td>
                                @if($rencana_pelaksanaan_kegiatan_tahunan->waktu_penerimaan)
                                    <span class="badge badge-pill badge-success"
                                          style="font-size: 10pt"
                                    >
                                        {{ $rencana_pelaksanaan_kegiatan_tahunan->waktu_penerimaan }}
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-danger"
                                          style="font-size: 10pt"
                                    >
                                        Belum Diterima
                                    </span>
                                @endif
                            </td>

                            <td class="text-right">
                                {{ \App\Support\Formatter::currency($rencana_pelaksanaan_kegiatan_tahunan->total_biaya) }}
                            </td>

                            <td class="text-center">
                                <a class="btn btn-dark" href="{{ route("rpk-tahunan-for-admin.edit", $rencana_pelaksanaan_kegiatan_tahunan)  }}">
                                    Ubah / Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center py-2">
            {{ $rpk_tahunans->links() }}
        </div>
    </div>
@endsection
