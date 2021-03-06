@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("puskesmas.rencana-lima-tahunan.index") }}">
                Rencana Lima Tahunan
            </a>

            /

            Tambah
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            @include("layouts._messages")

            <form method="POST"
                  action="{{ route("puskesmas.rencana-lima-tahunan.store") }}">
                @csrf

                <x-input
                    field="waktu_pembuatan"
                    label="Waktu Pembuatan"
                    type="datetime-local"
                ></x-input>

                <div class="form-group">
                    <label for="tahun_awal_periode"> Tahun Awal Periode: </label>
                    <input
                            id="tahun_awal_periode"
                            type="number"
                            placeholder="Tahun Awal Periode"
                            class="form-control @error("tahun_awal_periode") is-invalid @enderror"
                            name="tahun_awal_periode"
                            value="{{ old("tahun_awal_periode") }}"
                    />
                    @error("tahun_awal_periode")
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun_akhir_periode"> Tahun Akhir Periode: </label>
                    <input
                            id="tahun_akhir_periode"
                            type="number"
                            placeholder="Tahun Akhir Periode"
                            class="form-control @error("tahun_akhir_periode") is-invalid @enderror"
                            name="tahun_akhir_periode"
                            value="{{ old("tahun_akhir_periode") }}"
                    />
                    @error("tahun_akhir_periode")
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
                            <th> Tujuan</th>
                            <th> Indikator Kinerja</th>
                            <th> Cara Perhitungan</th>
                            <th> 1</th>
                            <th> 2</th>
                            <th> 3</th>
                            <th> 4</th>
                            <th> 5</th>
                            <th> Rincian Kegiatan</th>
                            <th> Kebutuhan Anggaran</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($unit_puskesmas_list AS $unit_puskesmas)
                            <tr class="font-weight-bold">
                                <td colspan="12"> {{ $unit_puskesmas->nama  }} </td>
                            </tr>

                            @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                                <tr>
                                    <td> {{ $loop->iteration }}.</td>
                                    <td> {{ $upaya_kesehatan->nama }} </td>

                                    <td>
                                        <x-inline-textarea
                                            placeholder="Tujuan"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="tujuan"
                                            :row_id="$loop->parent->index . $loop->index"
                                        ></x-inline-textarea>

                                        <input
                                            name="item_rencana_lima_tahunan_list[{{ $loop->parent->index . $loop->index }}][upaya_kesehatan_id]"
                                            value="{{ $upaya_kesehatan->id }}"
                                            type="hidden"
                                        >

                                    </td>

                                    <td>
                                        <x-inline-textarea
                                            placeholder="Indikator Kinerja"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="indikator_kinerja"
                                            :row_id="$loop->parent->index . $loop->index"
                                        ></x-inline-textarea>
                                    </td>

                                    <td>
                                        <x-inline-textarea
                                            placeholder="Cara Perhitungan"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="cara_perhitungan"
                                            :row_id="$loop->parent->index . $loop->index"
                                        ></x-inline-textarea>

                                    </td>

                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 1"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_1"
                                            :row_id="$loop->parent->index . $loop->index"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>


                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 2"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_2"
                                            :row_id="$loop->parent->index . $loop->index"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>

                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 3"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_3"
                                            :row_id="$loop->parent->index . $loop->index"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 4"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_4"
                                            :row_id="$loop->parent->index . $loop->index"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 5"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_5"
                                            :row_id="$loop->parent->index . $loop->index"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Rincian Kegiatan"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="rincian_kegiatan"
                                            :row_id="$loop->parent->index . $loop->index"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Kebutuhan Anggaran"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="kebutuhan_anggaran"
                                            :row_id="$loop->parent->index . $loop->index"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-lg btn-primary">
                        Tambahkan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
