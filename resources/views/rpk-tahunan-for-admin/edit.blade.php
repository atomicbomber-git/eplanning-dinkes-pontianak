@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("rpk-tahunan-for-admin.index")  }}">
                Rencana Pelaksanaan Kegiatan Tahunan
            </a>

            /

            Ubah
        </h1>

        <x-messages></x-messages>

        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route("rpk-tahunan-for-admin.update", $rpk_tahunan) }}"
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
                            <option value="1" {{ old("diterima", $rpk_tahunan->waktu_penerimaan === null ? "1" : "0") == "0" ? "selected" : "" }} > Ya </option>
                            <option value="0" {{ old("diterima", $rpk_tahunan->waktu_penerimaan === null ? "1" : "0") == "1" ? "selected" : "" }} > Tidak </option>
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
                    <dt> Waktu Pembuatan:</dt>
                    <dd> {{ \App\Support\Formatter::fancyDatetime($rpk_tahunan->waktu_pembuatan) }} </dd>

                    <dt> Tahun:</dt>
                    <dd> {{ $rpk_tahunan->tahun }} </dd>
                </dl>

                <table class="table table-sm">

                    <thead class="thead-dark">
                    <tr>
                        <th class="align-middle"> #</th>
                        <th class="align-middle"> Kegiatan</th>
                        <th class="align-middle"> Tujuan</th>
                        <th class="align-middle"> Sasaran</th>
                        <th class="align-middle"> Target Sasaran</th>
                        <th class="align-middle"> Penanggung Jawab</th>
                        <th class="align-middle"> Volume Kegiatan</th>
                        <th class="align-middle"> Jadwal</th>
                        <th class="align-middle"> Rincian Pelaksanaan</th>
                        <th class="align-middle"> Lokasi Pelaksanaan</th>
                        <th class="align-middle text-right"> Biaya</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($unit_puskesmases as $unit_puskesmas)
                        <tr class="border-top">
                            <td colspan="12"
                                class="font-weight-bold"
                            >
                                {{ $unit_puskesmas->nama }}
                            </td>
                        </tr>

                        @foreach ($unit_puskesmas->upaya_kesehatan_list as $upaya_kesehatan)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->kegiatan }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->tujuan }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->sasaran }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->target_sasaran }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->penanggung_jawab }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->volume_kegiatan }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->jadwal }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->rincian_pelaksanaan }} </p>
                                </td>
                                <td>
                                    <p> {{ $items[$upaya_kesehatan->id]->lokasi_pelaksanaan }} </p>
                                </td>
                                <td class="text-right">
                                    {{ \App\Support\Formatter::currency($items[$upaya_kesehatan->id]->biaya) }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
