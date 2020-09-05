@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("rencana-usulan-kegiatan-for-admin.index") }}">
                Rencana Usulan Kegiatan
            </a>

            /

            Ubah
        </h1>

        <x-messages></x-messages>

        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route("rencana-usulan-kegiatan-for-admin.update", $rencana_usulan_kegiatan) }}"
                      method="POST"
                >
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                        <label for="diterima"> Diterima: </label>
                        <select
                                id="diterima"
                                type="text"
                                class="form-control @error("diterima") is-invalid @enderror"
                                name="diterima"
                        >
                            <option value="1" {{ old("diterima", $rencana_usulan_kegiatan->waktu_penerimaan === null ? "1" : "0") == "0" ? "selected" : "" }} > Ya </option>
                            <option value="0" {{ old("diterima", $rencana_usulan_kegiatan->waktu_penerimaan === null ? "1" : "0") == "1" ? "selected" : "" }} > Tidak </option>
                        </select>
                        @error("diterima")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <dl>
                    <dt> Waktu Pembuatan: </dt>
                    <dd> {{ \App\Support\Formatter::fancyDatetime($rencana_usulan_kegiatan->waktu_pembuatan) }} </dd>

                    <dt> Tahun: </dt>
                    <dd> {{ $rencana_usulan_kegiatan->tahun }} </dd>
                </dl>

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
                            <th class="text-right"> Kebutuhan Anggaran</th>
                            <th> Indikator Kinerja</th>
                            <th> Sumber Pembiayaan</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($unit_puskesmases AS $unit_puskesmas)
                            <tr class="font-weight-bold">
                                <td colspan="13"> {{ $unit_puskesmas->nama  }} </td>
                            </tr>

                            @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $upaya_kesehatan->nama }} </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->kegiatan }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->tujuan }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->sasaran }}
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->target_sasaran }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->penanggung_jawab }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->kebutuhan_sumber_daya }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->mitra_kerja }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->waktu_pelaksanaan }}
                                    </td>
                                    <td class="text-right">
                                        {{ \App\Support\Formatter::currency($upaya_kesehatan->item_rencana_usulan_kegiatan->kebutuhan_anggaran) }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->indikator_kinerja }}
                                    </td>
                                    <td>
                                        {{ $upaya_kesehatan->item_rencana_usulan_kegiatan->sumber_pembiayaan }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection