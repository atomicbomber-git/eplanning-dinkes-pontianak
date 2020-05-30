@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>
            Rencana Pelaksanaan Kegiatan
        </h1>

        <div class="d-flex justify-content-end py-3">
            <a class="btn btn-dark" href="{{ route("puskesmas.rencana-pelaksanaan-kegiatan.create") }}">
                Tambah Rencana Pelaksanaan Kegiatan
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <table class="table table-sm table-striped">
                    <thead class="thead thead-dark">
                    <tr>
                        <th class="text-center"> # </th>
                        <th> Tanggal Pembuatan </th>
                        <th class="text-center"> Aksi </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rencana_pelaksanaan_kegiatan_list as $rencana_pelaksanaan_kegiatan)
                        <tr>
                            <td class="text-center"> {{ $loop->iteration }} </td>
                            <td> {{ \App\Support\Formatter::fancyDatetime($rencana_pelaksanaan_kegiatan->waktu_pembuatan) }} </td>
                            <td class="text-center">
                                <a class="btn btn-dark" href="{{ route("puskesmas.rencana-pelaksanaan-kegiatan.edit", $rencana_pelaksanaan_kegiatan)  }}">
                                    Sunting / Lihat
                                </a>

                                <form class="d-inline-block"
                                      action="{{ route('puskesmas.rencana-pelaksanaan-kegiatan.destroy', $rencana_pelaksanaan_kegiatan) }}"
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
            {{ $rencana_pelaksanaan_kegiatan_list->links() }}
        </div>
    </div>
@endsection
