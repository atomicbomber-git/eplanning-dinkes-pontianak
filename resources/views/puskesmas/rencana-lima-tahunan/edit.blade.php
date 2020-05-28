@extends("layouts.app")

@section("content")
    <h1> Sunting Rencana Lima Tahunan </h1>

    <div class="card">
        <div class="card-body">
            @include("layouts._messages")

            <form method="POST"
                  action="{{ route("puskesmas.rencana-lima-tahunan.update", $rencana_lima_tahunan) }}">
                @method("PATCH")
                @csrf

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

                        <body>
                        @foreach($unit_puskesmas_list AS $unit_puskesmas)
                            <tr class="font-weight-bold">
                                <td colspan="12"> {{ $unit_puskesmas->nama  }} </td>
                            </tr>

                            @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                                <tr>
                                    <td> {{ $loop->iteration }}.</td>
                                    <td> {{ $upaya_kesehatan->nama }} </td>

                                    <td>
                                        <label
                                            class="d-none"
                                            for="tujuan_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <textarea
                                            id="tujuan_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="text"
                                            rows="3"
                                            placeholder="Nama"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][tujuan]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][tujuan]"
                                        >{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][tujuan]", $upaya_kesehatan->item_rencana_lima_tahunan->tujuan)}}</textarea>
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][tujuan] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <input
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][id]"
                                            value="{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="hidden"
                                        >

                                    </td>

                                    <td>
                                        <label
                                            class="d-none"
                                            for="indikator_kinerja_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <textarea
                                            id="indikator_kinerja_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="text"
                                            rows="3"
                                            placeholder="Nama"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][indikator_kinerja]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][indikator_kinerja]"
                                        >{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][indikator_kinerja]", $upaya_kesehatan->item_rencana_lima_tahunan->indikator_kinerja)}}</textarea>
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][indikator_kinerja] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>

                                    <td>
                                        <label
                                            class="d-none"
                                            for="cara_perhitungan_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <textarea
                                            id="cara_perhitungan_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="text"
                                            rows="3"
                                            placeholder="Cara Perhitungan"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][cara_perhitungan]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][cara_perhitungan]"
                                        >{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][cara_perhitungan]", $upaya_kesehatan->item_rencana_lima_tahunan->cara_perhitungan)}}</textarea>
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][cara_perhitungan] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </td>

                                    <td>
                                        <label
                                            class="d-none"
                                            for="target_tahun_1_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <input
                                            id="target_tahun_1_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="number"
                                            step="any"
                                            placeholder="Target Tahun I"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_1]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_1]"
                                            value="{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_1]", $upaya_kesehatan->item_rencana_lima_tahunan->target_tahun_1) }}"
                                        />
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_1] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>


                                    <td>
                                        <label
                                            class="d-none"
                                            for="target_tahun_2_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <input
                                            id="target_tahun_2_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="number"
                                            step="any"
                                            placeholder="Target Tahun II"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_2]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_2]"
                                            value="{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_2]", $upaya_kesehatan->item_rencana_lima_tahunan->target_tahun_2) }}"
                                        />
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_2] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>

                                    <td>
                                        <label
                                            class="d-none"
                                            for="target_tahun_3_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <input
                                            id="target_tahun_3_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="number"
                                            step="any"
                                            placeholder="Target Tahun III"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_3]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_3]"
                                            value="{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_3]", $upaya_kesehatan->item_rencana_lima_tahunan->target_tahun_3) }}"
                                        />
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_3] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                    <td>
                                        <label
                                            class="d-none"
                                            for="target_tahun_4_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <input
                                            id="target_tahun_4_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="number"
                                            step="any"
                                            placeholder="Target Tahun IV"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_4]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_4]"
                                            value="{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_4]", $upaya_kesehatan->item_rencana_lima_tahunan->target_tahun_4) }}"
                                        />
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_4] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                    <td>
                                        <label
                                            class="d-none"
                                            for="target_tahun_5_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <input
                                            id="target_tahun_5_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="number"
                                            step="any"
                                            placeholder="Target Tahun V"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_5]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][target_tahun_5]"
                                            value="{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_5]", $upaya_kesehatan->item_rencana_lima_tahunan->target_tahun_5) }}"
                                        />
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][target_tahun_5] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                    <td>
                                        <label
                                            class="d-none"
                                            for="rincian_kegiatan_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <textarea
                                            id="rincian_kegiatan_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="text"
                                            rows="3"
                                            placeholder="Rincian Kegiatan"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][rincian_kegiatan]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][rincian_kegiatan]"
                                        >{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][rincian_kegiatan]", $upaya_kesehatan->item_rencana_lima_tahunan->rincian_kegiatan)}}</textarea>
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][rincian_kegiatan] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                    <td>
                                        <label
                                            class="d-none"
                                            for="kebutuhan_anggaran_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"></label>
                                        <input
                                            id="kebutuhan_anggaran_{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="number"
                                            step="any"
                                            placeholder="Kebutuhan Anggaran"
                                            class="form-control form-control-sm rlt-textarea @error("item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][kebutuhan_anggaran]") is-invalid @enderror "
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][kebutuhan_anggaran]"
                                            value="{{ old("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][kebutuhan_anggaran]", \App\Support\Formatter::normalizeNumber($upaya_kesehatan->item_rencana_lima_tahunan->kebutuhan_anggaran) ) }}"
                                        />
                                        @error("item_rencana_lima_tahunan_list[{$upaya_kesehatan->item_rencana_lima_tahunan->id}][kebutuhan_anggaran] ")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
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
