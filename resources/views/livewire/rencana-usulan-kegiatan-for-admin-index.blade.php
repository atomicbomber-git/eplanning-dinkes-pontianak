<div class="container">
    <h1 class="feature-title">
        Rencana Usulan Kegiatan
    </h1>

    @if($rencana_usulan_kegiatans->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr class="thead thead-dark">
                    <th> # </th>
                    <th> Tahun </th>
                    <th> Waktu Pembuatan </th>
                    <th> Waktu Penerimaan </th>
                    <th class="text-right"> Total Kebutuhan Anggaran (Rp.) </th>
                    <th class="text-center"> Aksi </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($rencana_usulan_kegiatans as $rencana_usulan_kegiatan)
                    <tr>
                        <td> {{ $rencana_usulan_kegiatans->firstItem() + $loop->index }} </td>
                        <td> {{ $rencana_usulan_kegiatan->tahun }} </td>
                        <td> {{ \App\Support\Formatter::fancyDatetime($rencana_usulan_kegiatan->waktu_pembuatan) }} </td>
                        <td>
                            @if($rencana_usulan_kegiatan->waktu_penerimaan)
                                <span class="badge badge-pill badge-success" style="font-size: 10pt">
                                    {{ \App\Support\Formatter::fancyDatetime($rencana_usulan_kegiatan->waktu_penerimaan) }}
                                </span>
                            @else
                                <span class="badge badge-pill badge-danger" style="font-size: 10pt">
                                    Belum Diterima
                                </span>
                            @endif
                        </td>
                        <td class="text-right">
                            {{ \App\Support\Formatter::currency($rencana_usulan_kegiatan->total_kebutuhan_anggaran) }}
                        </td>

                        <td class="text-center">
                            <a class="btn btn-dark" href="{{ route("rencana-usulan-kegiatan-for-admin.edit", $rencana_usulan_kegiatan)  }}">
                                Ubah / Lihat
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $rencana_usulan_kegiatans->links() }}
        </div>

    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            {{ __("messages.errors.no_data") }}
        </div>
    @endif
</div>
