@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>
            Rencana Usulan Kegiatan
        </h1>

        <x-messages></x-messages>

        <div class="d-flex justify-content-end py-3">
            <a class="btn btn-dark"
               href="{{ route("puskesmas.rencana-usulan-kegiatan.create") }}"
            >
                Tambah
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <thead class="thead thead-dark">
                    <tr>
                        <th class="text-center"> #</th>
                        <th> Tahun</th>
                        <th> Waktu Pembuatan</th>
                        <th> Waktu Penerimaan</th>
                        <th class="text-right"> Total Kebutuhan Anggaran (Rp.)</th>
                        <th class="text-center"> Kendali</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rencana_usulan_kegiatan_list as $rencana_usulan_kegiatan)
                        <tr>
                            <td class="text-center"> {{ $loop->iteration }} </td>
                            <td> {{ $rencana_usulan_kegiatan->tahun }} </td>
                            <td> {{ \App\Support\Formatter::fancyDatetime($rencana_usulan_kegiatan->waktu_pembuatan) }} </td>
                            <td>
                                @if($rencana_usulan_kegiatan->waktu_penerimaan)
                                    <span class="badge badge-pill badge-success"
                                          style="font-size: 10pt"
                                    >
                                        {{ $rencana_usulan_kegiatan->waktu_penerimaan }}
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
                                {{ \App\Support\Formatter::currency($rencana_usulan_kegiatan->total_kebutuhan_anggaran) }}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-dark"
                                   href="{{ route("puskesmas.rencana-usulan-kegiatan.edit", $rencana_usulan_kegiatan)  }}"
                                >
                                    Ubah / Lihat
                                </a>

                                <form
                                        x-data="{}"
                                        x-on:submit.prevent="
                                        window.confirmDialog()
                                            .then(response => {
                                                if (response.value) {
                                                   $($event.target)
                                                        .off('submit')
                                                        .submit()
                                                }
                                            })
"
                                        class="d-inline-block"
                                        action="{{ route('puskesmas.rencana-usulan-kegiatan.destroy', $rencana_usulan_kegiatan) }}"
                                        method="post"
                                >
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger"
                                            type="submit"
                                    >
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
            {{ $rencana_usulan_kegiatan_list->links() }}
        </div>
    </div>
@endsection
