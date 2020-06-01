@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Edit Item Rencana Pelaksanaan Kegiatan Tahun </h1>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <form
                    method="POST"
                    action="{{ route("puskesmas.item-rpk-tahunan.update", $item_rpk_tahunan)  }}">
                    @method("PATCH")
                    @csrf

                    <x-select-upaya-kesehatan
                        :unit_puskesmas_list="$unit_puskesmas_list"
                        :upaya_kesehatan_id="$item_rpk_tahunan->upaya_kesehatan_id"
                    ></x-select-upaya-kesehatan>

                    <x-textarea
                        field="kegiatan"
                        label="Kegiatan"
                        :value="$item_rpk_tahunan->kegiatan"
                    ></x-textarea>
                    <x-textarea
                        field="tujuan"
                        label="Tujuan"
                        :value="$item_rpk_tahunan->tujuan"
                    ></x-textarea>
                    <x-textarea
                        field="sasaran"
                        label="Sasaran"
                        :value="$item_rpk_tahunan->sasaran"
                    ></x-textarea>
                    <x-textarea
                        field="target_sasaran"
                        label="Target Sasaran"
                        :value="$item_rpk_tahunan->target_sasaran"
                    ></x-textarea>
                    <x-textarea
                        field="penanggung_jawab"
                        label="Penanggung Jawab"
                        :value="$item_rpk_tahunan->penanggung_jawab"
                    ></x-textarea>
                    <x-textarea
                        field="volume_kegiatan"
                        label="Volume Kegiatan"
                        :value="$item_rpk_tahunan->volume_kegiatan"
                    ></x-textarea>
                    <x-textarea
                        field="jadwal"
                        label="Jadwal"
                        :value="$item_rpk_tahunan->jadwal"
                    ></x-textarea>
                    <x-textarea
                        field="rincian_pelaksanaan"
                        label="Rincian Pelaksanaan"
                        :value="$item_rpk_tahunan->rincian_pelaksanaan"
                    ></x-textarea>
                    <x-textarea
                        field="lokasi_pelaksanaan"
                        label="Lokasi Pelaksanaan"
                        :value="$item_rpk_tahunan->lokasi_pelaksanaan"
                    ></x-textarea>
                    <x-input
                        field="biaya"
                        type="number"
                        step="any"
                        label="Biaya"
                        :value="$item_rpk_tahunan->biaya"
                    ></x-input>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary"
                                type="submit">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
