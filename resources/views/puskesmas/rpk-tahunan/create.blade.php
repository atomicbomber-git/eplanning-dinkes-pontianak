@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("puskesmas.rpk-tahunan.index")  }}">
                Rencana Pelaksanaan Kegiatan Tahunan
            </a>

            /

            Tambah
        </h1>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <form method="POST"
                      action="{{ route("puskesmas.rpk-tahunan.store") }}">
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

                    <div class="form-group">
                        <label for="tahun"> Tahun: </label>
                        <input
                                id="tahun"
                                type="number"
                                placeholder="Tahun"
                                class="form-control @error("tahun") is-invalid @enderror"
                                name="tahun"
                                value="{{ old("tahun") }}"
                        />
                        @error("tahun")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    <table class="table table-sm">
                        
                        <thead class="thead-dark">
                            <tr>
                                <th class="align-middle"> # </th>
                                <th class="align-middle"> Kegiatan </th>
                                <th class="align-middle"> Tujuan </th>
                                <th class="align-middle"> Sasaran </th>
                                <th class="align-middle"> Target Sasaran </th>
                                <th class="align-middle"> Penanggung Jawab </th>
                                <th class="align-middle"> Volume Kegiatan </th>
                                <th class="align-middle"> Jadwal </th>
                                <th class="align-middle"> Rincian Pelaksanaan </th>
                                <th class="align-middle"> Lokasi Pelaksanaan </th>
                                <th class="align-middle text-right"> Biaya </th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($unit_puskesmases as $unit_puskesmas)
                            <tr class="border-top">
                               <td colspan="12" class="font-weight-bold">
                                   {{ $unit_puskesmas->nama }}
                               </td>
                            </tr>

                            @foreach ($unit_puskesmas->upaya_kesehatan_list as $upaya_kesehatan)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                        <label for="upaya_kesehatan_id">
                                                <input
                                                        type="hidden"
                                                        class="form-control @error("upaya_kesehatan_id") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][upaya_kesehatan_id]"
                                                        value="{{ $upaya_kesehatan->id }}"
                                                />
                                            @error("upaya_kesehatan_id")
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="kegiatan">
                                                <textarea
                                                        placeholder="Kegiatan"
                                                        class="form-control @error("kegiatan") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][kegiatan]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.kegiatan") }}</textarea>
                                            @error("kegiatan")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="tujuan">
                                                <textarea
                                                        placeholder="Tujuan"
                                                        class="form-control @error("tujuan") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][tujuan]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.tujuan") }}</textarea>
                                            @error("tujuan")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="sasaran">
                                                <textarea
                                                        placeholder="Sasaran"
                                                        class="form-control @error("sasaran") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][sasaran]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.sasaran") }}</textarea>
                                            @error("sasaran")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="target_sasaran">
                                                <textarea
                                                        placeholder="Target Sasaran"
                                                        class="form-control @error("target_sasaran") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][target_sasaran]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.target_sasaran") }}</textarea>
                                            @error("target_sasaran")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="penanggung_jawab">
                                                <textarea
                                                        placeholder="Penanggung Jawab"
                                                        class="form-control @error("penanggung_jawab") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][penanggung_jawab]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.penanggung_jawab") }}</textarea>
                                            @error("penanggung_jawab")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="volume_kegiatan">
                                                <textarea
                                                        placeholder="Volume Kegiatan"
                                                        class="form-control @error("volume_kegiatan") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][volume_kegiatan]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.volume_kegiatan") }}</textarea>
                                            @error("volume_kegiatan")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="jadwal">
                                                <textarea
                                                        placeholder="Jadwal"
                                                        class="form-control @error("jadwal") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][jadwal]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.jadwal") }}</textarea>
                                            @error("jadwal")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="rincian_pelaksanaan">
                                                <textarea
                                                        placeholder="Rincian Pelaksanaan"
                                                        class="form-control @error("rincian_pelaksanaan") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][rincian_pelaksanaan]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.rincian_pelaksanaan") }}</textarea>
                                            @error("rincian_pelaksanaan")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="lokasi_pelaksanaan">
                                                <textarea
                                                        placeholder="Lokasi Pelaksanaan"
                                                        class="form-control @error("lokasi_pelaksanaan") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][lokasi_pelaksanaan]"
                                                >{{ old("item.{$loop->parent->index}{$loop->index}.lokasi_pelaksanaan") }}</textarea>
                                            @error("lokasi_pelaksanaan")
                                            <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label for="biaya">
                                                <input
                                                        type="number"
                                                        placeholder="Biaya"
                                                        class="text-right form-control @error("biaya") is-invalid @enderror"
                                                        name="item[{{ "{$loop->parent->index}{$loop->index}" }}][biaya]"
                                                        value="{{ old("biaya") }}"
                                                />
                                            @error("biaya")
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>

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
