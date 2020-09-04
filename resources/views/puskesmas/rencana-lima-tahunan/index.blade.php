@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>
            Rencana Lima Tahunan
        </h1>

        <div class="d-flex justify-content-end py-3">
            <a class="btn btn-dark" href="{{ route("puskesmas.rencana-lima-tahunan.create") }}">
                Tambah Rencana Lima Tahunan
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <table class="table table-sm table-striped">
                    <thead class="thead thead-dark">
                    <tr>
                        <th class="text-center"> # </th>
                        <th> Waktu Pembuatan </th>
                        <th> Periode </th>
                        <th> Waktu Penerimaan </th>
                        <th class="text-center"> Aksi </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rencana_lima_tahunan_list as $rencana_lima_tahunan)
                        <tr>
                            <td class="text-center"> {{ $loop->iteration }} </td>
                            <td> {{ \App\Support\Formatter::fancyDatetime($rencana_lima_tahunan->waktu_pembuatan) }} </td>
                            <td>
                                {{ $rencana_lima_tahunan->tahun_awal_periode }}-{{ $rencana_lima_tahunan->tahun_akhir_periode }}
                            </td>
                            <td>
                                @if($rencana_lima_tahunan->waktu_penerimaan)
                                    <span class="badge badge-pill badge-success" style="font-size: 10pt">
                                        {{ $rencana_lima_tahunan->waktu_penerimaan }}
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-danger" style="font-size: 10pt">
                                        Belum Diterima
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-dark" href="{{ route("puskesmas.rencana-lima-tahunan.edit", $rencana_lima_tahunan)  }}">
                                    Sunting / Lihat
                                </a>

                                <form class="d-inline-block"
                                      action="{{ route('puskesmas.rencana-lima-tahunan.destroy', $rencana_lima_tahunan) }}"
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
            {{ $rencana_lima_tahunan_list->links() }}
        </div>
    </div>
@endsection
