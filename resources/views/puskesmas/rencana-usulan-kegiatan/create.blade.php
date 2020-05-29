@extends("layouts.app")

@section("content")
    <h1> Tambah Rencana Usulan Kegiatan </h1>

    <div class="card">
        <div class="card-body">
            @include("layouts._messages")

            <form method="POST"
                  action="{{ route("puskesmas.rencana-usulan-kegiatan.store") }}">
                @csrf

                <div class="form-group">
                    <label for="waktu_pembuatan"> Waktu Pembuatan: </label>
                    <input
                        id="waktu_pembuatan"
                        type="datetime-local"
                        placeholder="Waktu Pembuatan"
                        class="form-control @error("waktu_pembuatan") is-invalid @enderror"
                        name="waktu_pembuatan"
                        value="{{ old("waktu_pembuatan") }}"
                    />
                    @error("waktu_pembuatan")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

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
                                            row_id="{{ $loop->parent->index . $loop->index }}"
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
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Sasaran"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="sasaran"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Target Sasaran"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="target_sasaran"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Penanggung Jawab"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="penanggung_jawab"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Kebutuhan Sumber Daya"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="kebutuhan_sumber_daya"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Mitra Kerja"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="mitra_kerja"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Waktu Pelaksanaan"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="waktu_pelaksanaan"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Kebutuhan Anggaran"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="kebutuhan_anggaran"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Indikator Kinerja"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="indikator_kinerja"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Sumber Pembiayaan"
                                            array_name="item_rencana_usulan_kegiatan_list"
                                            field="sumber_pembiayaan"
                                            row_id="{{ $loop->parent->index . $loop->index }}"
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
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
