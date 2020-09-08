@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>
            Rencana Pelaksanaan Kegiatan Tahunan
        </h1>

        <x-messages></x-messages>

        <div class="d-flex justify-content-end py-3">
            <a class="btn btn-dark" href="{{ route("puskesmas.rpk-tahunan.create") }}">
                Tambah
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <thead class="thead thead-dark">
                    <tr>
                        <th class="text-center"> # </th>
                        <th> Tahun</th>
                        <th> Waktu Pembuatan</th>
                        <th> Waktu Penerimaan</th>
                        <th class="text-right"> Total Biaya (Rp.)</th>
                        <th class="text-center"> Kendali</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rencana_pelaksanaan_kegiatan_tahunan_list as $rencana_pelaksanaan_kegiatan_tahunan)
                        <tr>
                            <td class="text-center"> {{ $rencana_pelaksanaan_kegiatan_tahunan_list->firstItem() + $loop->index }} </td>
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
                                <a class="btn btn-dark" href="{{ route("puskesmas.rpk-tahunan.edit", $rencana_pelaksanaan_kegiatan_tahunan)  }}">
                                    Ubah / Lihat
                                </a>

                                <form class="d-inline-block"
                                      action="{{ route('puskesmas.rpk-tahunan.destroy', $rencana_pelaksanaan_kegiatan_tahunan) }}"
                                      method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger"
                                            type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center py-2">
            {{ $rencana_pelaksanaan_kegiatan_tahunan_list->links() }}
        </div>
    </div>
@endsection
