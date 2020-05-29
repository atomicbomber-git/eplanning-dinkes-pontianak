@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Sunting Rencana Usulan Kegiatan </h1>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <form method="POST"
                      action="{{ route("puskesmas.rencana-usulan-kegiatan.update", $rencana_usulan_kegiatan) }}">
                    @method("PATCH")
                    @csrf

                    <x-input
                        field="waktu_pembuatan"
                        label="Waktu Pembuatan"
                        type="datetime-local"
                        :value="$rencana_usulan_kegiatan->waktu_pembuatan->format('Y-m-d\TH:i:s')"
                    ></x-input>

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="thead thead-dark">
                            <tr>
                                <th> No</th>
                                <th> Upaya Kesehatan</th>
                                <th> Kegiatan</th>
                                <th> Tujuan</th>
                                <th> Sasaran</th>
                                <th> Target Sasaran</th>
                                <th> Penanggung Jawab</th>
                                <th> Kebutuhan Sumber Daya</th>
                                <th> Mitra Kerja</th>
                                <th> Waktu Pelaksanaan</th>
                                <th> Kebutuhan Anggaran</th>
                                <th> Indikator Kinerja</th>
                                <th> Sumber Pembiayaan</th>
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
                                            <x-inline-textarea
                                                placeholder="Kegiatan"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="kegiatan"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>

                                            <input
                                                name="item_rencana_usulan_kegiatan_list[{{ $upaya_kesehatan->item_rencana_usulan_kegiatan->id }}][id]"
                                                value="{{ $upaya_kesehatan->item_rencana_usulan_kegiatan->id }}"
                                                type="hidden"
                                            >
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Tujuan"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="tujuan"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Sasaran"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="sasaran"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Target Sasaran"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="target_sasaran"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Penanggung Jawab"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="penanggung_jawab"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Kebutuhan Sumber Daya"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="kebutuhan_sumber_daya"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Mitra Kerja"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="mitra_kerja"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Waktu Pelaksanaan"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="waktu_pelaksanaan"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-input
                                                placeholder="Kebutuhan Anggaran"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="kebutuhan_anggaran"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                                type="number"
                                                step="any"
                                            ></x-inline-input>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Indikator Kinerja"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="indikator_kinerja"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                placeholder="Sumber Pembiayaan"
                                                array_name="item_rencana_usulan_kegiatan_list"
                                                field="sumber_pembiayaan"
                                                :item="$upaya_kesehatan->item_rencana_usulan_kegiatan"
                                                :row_id="$upaya_kesehatan->item_rencana_usulan_kegiatan->id"
                                            ></x-inline-textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </body>
                        </table>
                    </div>

                    <div class="form-group d-flex justify-content-end py-3">
                        <button class="btn btn-lg btn-primary">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
