@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Sunting Rencana Lima Tahunan </h1>
    </div>

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
                            <th class="align-middle"> No</th>
                            <th class="align-middle"> Upaya Kesehatan</th>
                            <th class="align-middle"> Tujuan</th>
                            <th class="align-middle"> Indikator Kinerja</th>
                            <th class="align-middle"> Cara Perhitungan</th>
                            <th class="align-middle"> 1</th>
                            <th class="align-middle"> 2</th>
                            <th class="align-middle"> 3</th>
                            <th class="align-middle"> 4</th>
                            <th class="align-middle"> 5</th>
                            <th class="align-middle"> Rincian Kegiatan</th>
                            <th class="align-middle"> Kebutuhan Anggaran</th>
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
                                        <x-inline-textarea
                                            placeholder="Tujuan"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="tujuan"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                        ></x-inline-textarea>

                                        <input
                                            name="item_rencana_lima_tahunan_list[{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}][id]"
                                            value="{{ $upaya_kesehatan->item_rencana_lima_tahunan->id }}"
                                            type="hidden"
                                        >

                                    </td>

                                    <td>
                                        <x-inline-textarea
                                            placeholder="Indikator Kinerja"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="indikator_kinerja"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                        ></x-inline-textarea>
                                    </td>

                                    <td>
                                        <x-inline-textarea
                                            placeholder="Cara Perhitungan"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="cara_perhitungan"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                        ></x-inline-textarea>

                                    </td>

                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 1"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_1"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>


                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 2"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_2"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>

                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 3"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_3"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 4"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_4"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Target Tahun 5"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="target_tahun_5"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
                                    </td>
                                    <td>
                                        <x-inline-textarea
                                            placeholder="Rincian Kegiatan"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="rincian_kegiatan"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                        ></x-inline-textarea>
                                    </td>
                                    <td>
                                        <x-inline-input
                                            placeholder="Kebutuhan Anggaran"
                                            array_name="item_rencana_lima_tahunan_list"
                                            field="kebutuhan_anggaran"
                                            :item="$upaya_kesehatan->item_rencana_lima_tahunan"
                                            :row_id="$upaya_kesehatan->item_rencana_lima_tahunan->id"
                                            type="number"
                                            step="any"
                                        ></x-inline-input>
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
