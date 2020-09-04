@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("rencana-lima-tahunan-for-admin.index") }}">
                Rencana Lima Tahunan
            </a>

            /

            Ubah
        </h1>

        @include("layouts._messages")

        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route("rencana-lima-tahunan-for-admin.update", $rencana_lima_tahunan) }}"
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
                            <option value="1" {{ old("diterima", $rencana_lima_tahunan->waktu_penerimaan === null ? "1" : "0") == "0" ? "selected" : "" }} > Ya </option>
                            <option value="0" {{ old("diterima", $rencana_lima_tahunan->waktu_penerimaan === null ? "1" : "0") == "1" ? "selected" : "" }} > Tidak </option>
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
                    <dt> Waktu Pembuatan </dt>
                    <dd> {{ \App\Support\Formatter::fancyDatetime($rencana_lima_tahunan->waktu_pembuatan) }} </dd>
                </dl>

                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="thead thead-dark">
                        <tr>
                            <th> No</th>
                            <th> Upaya Kesehatan </th>
                            <th> Tujuan </th>
                            <th> Indikator Kinerja </th>
                            <th> Cara Perhitungan </th>
                            <th> 1 </th>
                            <th> 2 </th>
                            <th> 3 </th>
                            <th> 4 </th>
                            <th> 5 </th>
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
                                        <p>
                                            {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->tujuan }}
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->indikator_kinerja  }}
                                        </p>s
                                    </td>

                                    <td>
                                        <p>
                                            {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->cara_perhitungan  }}
                                        </p>
                                    </td>

                                    <td>
                                        {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->target_tahun_1 }}
                                    </td>

                                    <td>
                                        {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->target_tahun_2 }}
                                    </td>

                                    <td>
                                        {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->target_tahun_3 }}
                                    </td>

                                    <td>
                                        {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->target_tahun_4 }}
                                    </td>

                                    <td>
                                        {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->target_tahun_5 }}
                                    </td>

                                    <td>
                                        <p>
                                            {{ $item_rencana_lima_tahunan[$upaya_kesehatan->id]->rincian_kegiatan }}
                                        </p>
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Support\Formatter::currency($item_rencana_lima_tahunan[$upaya_kesehatan->id]->kebutuhan_anggaran) }}
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