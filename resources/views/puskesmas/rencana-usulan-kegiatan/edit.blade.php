@extends("layouts.app")

@section("content")
    <h1> Sunting Rencana Lima Tahunan </h1>

    <div class="card">
        <div class="card-body">
            @include("layouts._messages")

            <form method="POST"
                  action="{{ route("puskesmas.rencana-usulan-kegiatan.update", $rencana_usulan_kegiatan) }}">
                @method("PATCH")
                @csrf

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="thead thead-dark">
                        <tr>
                            <th> No</th>
                            <th> Upaya Kesehatan</th>
                            <th> Kegiatan </th>
                            <th> Tujuan </th>
                            <th> Sasaran </th>
                            <th> Target Sasaran </th>
                            <th> Penanggung Jawab </th>
                            <th> Kebutuhan Sumber Daya </th>
                            <th> Mitra Kerja </th>
                            <th> Waktu Pelaksanaan </th>
                            <th> Kebutuhan Anggaran </th>
                            <th> Indikator Kinerja </th>
                            <th> Sumber Pembiayaan </th>
                        </tr>
                        </thead>

                        <body>
                        @foreach($unit_puskesmas_list AS $unit_puskesmas)
                            <tr class="font-weight-bold">
                                <td colspan="12"> {{ $unit_puskesmas->nama  }} </td>
                            </tr>

                            @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $upaya_kesehatan->nama }} </td>
                                    <td>
                                        <label
                                            class="d-none"
                                            for="kegiatan_{{ $upaya_kesehatan->item_rencana_usulan_kegiatan->id }}"></label>
                                        <textarea
                                            id="kegiatan_{{ $upaya_kesehatan->item_rencana_usulan_kegiatan->id }}"
                                            type="text"
                                            rows="3"
                                            placeholder="Nama"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_usulan_kegiatan_list[{{ $upaya_kesehatan->item_rencana_usulan_kegiatan->id }}][kegiatan]") is-invalid @enderror "
                                            name="item_rencana_usulan_kegiatan_list[{{ $upaya_kesehatan->item_rencana_usulan_kegiatan->id }}][kegiatan]"
                                        >{{ old("item_rencana_usulan_kegiatan_list[{$upaya_kesehatan->item_rencana_usulan_kegiatan->id}][kegiatan]", $upaya_kesehatan->item_rencana_usulan_kegiatan->kegiatan)}}</textarea>
                                        @error("item_rencana_usulan_kegiatan_list[{$upaya_kesehatan->item_rencana_usulan_kegiatan->id}][kegiatan] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->tujuan }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->sasaran }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->target_sasaran }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->penanggung_jawab }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->kebutuhan_sumber_daya }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->mitra_kerja }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->waktu_pelaksanaan }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->kebutuhan_anggaran }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->indikator_kinerja }} </td>
                                    <td> {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->sumber_pembiayaan }} </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </body>
                    </table>
                </div>

                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-lg btn-primary">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
