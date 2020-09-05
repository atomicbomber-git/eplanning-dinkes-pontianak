<div class="container">
    <h1 class="feature-title">
        Rencana Lima Tahunan
    </h1>

    <x-messages></x-messages>

    <div>
        @if($rencana_lima_tahunans->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th> # </th>
                        <th> Puskesmas </th>
                        <th> Waktu Pembuatan </th>
                        <th> Periode </th>
                        <th> Waktu Penerimaan </th>
                        <th class="text-center"> Kendali </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($rencana_lima_tahunans as $rencana_lima_tahunan)
                        <tr>
                            <td> {{ $rencana_lima_tahunans->firstItem() + $loop->index }} </td>
                            <td> {{ $rencana_lima_tahunan->puskesmas->nama }} </td>
                            <td> {{ $rencana_lima_tahunan->waktu_pembuatan }} </td>
                            <td>
                                {{ $rencana_lima_tahunan->tahun_awal_periode }}-{{ $rencana_lima_tahunan->tahun_akhir_periode }}
                            </td>
                            <td>
                                @if($rencana_lima_tahunan->waktu_penerimaan)
                                    <span class="badge badge-pill badge-success" style="font-size: 10pt">
                                        {{ \App\Support\Formatter::fancyDatetime($rencana_lima_tahunan->waktu_penerimaan) }}
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-danger" style="font-size: 10pt">
                                        Belum Diterima
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a
                                        class="btn btn-dark btn-sm"
                                        href="{{ route("rencana-lima-tahunan-for-admin.edit", $rencana_lima_tahunan) }}">
                                    Ubah / Lihat
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $rencana_lima_tahunans->links() }}
            </div>

        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ __("messages.errors.no_data") }}
            </div>
        @endif
    </div>

</div>
