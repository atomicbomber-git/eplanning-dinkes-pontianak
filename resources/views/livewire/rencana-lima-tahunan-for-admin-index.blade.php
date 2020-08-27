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
                                @if($rencana_lima_tahunan->waktu_penerimaan)
                                    {{ $rencana_lima_tahunan->waktu_penerimaan }}
                                @else
                                    <span class="badge badge-pill badge-danger">
                                        Belum Diterima
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
{{--                                @if($rencana_lima_tahunan->waktu_penerimaan)--}}
{{--                                    <a href="" class="btn btn-warning">--}}
{{--                                        Batalkan Penerimaan--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <a href="{{ route("penerimaan-rencana-lima-tahunan.create") }}" class="btn btn-success btn-sm">--}}
{{--                                        Terima--}}
{{--                                        <i class="fas fa-check"></i>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
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
