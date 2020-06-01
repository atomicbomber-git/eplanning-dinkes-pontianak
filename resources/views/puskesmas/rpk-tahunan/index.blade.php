@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>
            Rencana Pelaksanaan Kegiatan Tahunan
        </h1>

        <div class="d-flex justify-content-end py-3">
            <a class="btn btn-dark" href="{{ route("puskesmas.rpk-tahunan.create") }}">
                Tambah Rencana Pelaksanaan Kegiatan Tahunan
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <table class="table table-sm table-striped">
                    <thead class="thead thead-dark">
                    <tr>
                        <th class="text-center"> # </th>
                        <th> Tahun </th>
                        <th class="text-center"> Aksi </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rencana_pelaksanaan_kegiatan_tahunan_list as $rencana_pelaksanaan_kegiatan_tahunan)
                        <tr>
                            <td class="text-center"> {{ $loop->iteration }} </td>
                            <td> {{ $rencana_pelaksanaan_kegiatan_tahunan->tahun }} </td>
                            <td class="text-center">
                                <a class="btn btn-dark" href="{{ route("puskesmas.rpk-tahunan.item-rpk-tahunan.index", $rencana_pelaksanaan_kegiatan_tahunan)  }}">
                                    Detail
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
