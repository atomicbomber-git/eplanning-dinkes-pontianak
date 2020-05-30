@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Tambah Rencana Usulan Kegiatan</h1>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <form method="POST"
                      action="{{ route("puskesmas.rencana-pelaksanaan-kegiatan.store") }}">
                    @csrf

                    <x-input
                        field="waktu_pembuatan"
                        label="Waktu Pembuatan"
                        type="datetime-local"
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
                                <th> Volume Kegiatan</th>
                                <th> Jadwal</th>
                                <th> Rincian Pelaksanaan</th>
                                <th> Lokasi Pelaksanaan</th>
                                <th> Biaya</th>
                            </tr>
                            </thead>

                            <tbody>
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
                                                field="kegiatan"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Kegiatan"
                                            ></x-inline-textarea>

                                            <input
                                                name="item_rencana_pelaksanaan_kegiatan_list[{{ $loop->parent->index . $loop->index }}][upaya_kesehatan_id]"
                                                type="hidden"
                                                value="{{ $upaya_kesehatan->id }}"
                                            >
                                        </td>

                                        <td>
                                            <x-inline-textarea
                                                field="tujuan"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Tujuan"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="sasaran"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Sasaran"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="target_sasaran"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Target Sasaran"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="penanggung_jawab"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Penanggung Jawab"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="volume_kegiatan"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Volume Kegiatan"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="jadwal"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Jadwal"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="rincian_pelaksanaan"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Rincian Pelaksanaan"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-textarea
                                                field="lokasi_pelaksanaan"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                :row_id="$loop->parent->index . $loop->index"
                                                placeholder="Lokasi Pelaksanaan"
                                            ></x-inline-textarea>
                                        </td>
                                        <td>
                                            <x-inline-input
                                                placeholder="Biaya"
                                                array_name="item_rencana_pelaksanaan_kegiatan_list"
                                                field="biaya"
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
