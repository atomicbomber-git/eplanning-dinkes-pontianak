@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Tambah Item Rencana Pelaksanaan Kegiatan Tahun</h1>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <form
                    method="POST"
                    action="{{ route("puskesmas.rpk-tahunan.item-rpk-tahunan.store", $rpk_tahunan)  }}">
                    @csrf

                    <x-select-upaya-kesehatan
                        :unit_puskesmas_list="$unit_puskesmas_list"
                    ></x-select-upaya-kesehatan>

                    <x-textarea
                        field="kegiatan"
                        label="Kegiatan"
                    ></x-textarea>

                    <x-textarea
                        field="tujuan"
                        label="Tujuan"
                    ></x-textarea>

                    <x-textarea
                        field="sasaran"
                        label="Sasaran"
                    ></x-textarea>

                    <x-textarea
                        field="target_sasaran"
                        label="Target Sasaran"
                    ></x-textarea>

                    <x-textarea
                        field="penanggung_jawab"
                        label="Penanggung Jawab"
                    ></x-textarea>

                    <x-textarea
                        field="volume_kegiatan"
                        label="Volume Kegiatan"
                    ></x-textarea>

                    <x-textarea
                        field="jadwal"
                        label="Jadwal"
                    ></x-textarea>

                    <x-textarea
                        field="rincian_pelaksanaan"
                        label="Rincian Pelaksanaan"
                    ></x-textarea>

                    <x-textarea
                        field="lokasi_pelaksanaan"
                        label="Lokasi Pelaksanaan"
                    ></x-textarea>

                    <x-input
                        field="biaya"
                        type="number"
                        step="any"
                        label="Biaya"
                    ></x-input>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary"
                                type="submit">
                            Tambahkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
