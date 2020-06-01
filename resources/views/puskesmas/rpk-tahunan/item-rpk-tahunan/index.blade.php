@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Item Rencana Pelaksanaan Kegiatan Tahun {{ $rpk_tahunan->tahun }} </h1>

        <div class="d-flex justify-content-end py-3">
            <a class="btn btn-dark" href="{{ route("puskesmas.rpk-tahunan.item-rpk-tahunan.create", $rpk_tahunan) }}">
                Tambah Item
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="thead thead-dark">
                        <tr>
                            <th class="mw-70 align-middle text-center"> No </th>
                            <th class="mw-70 align-middle"> Upaya Kesehatan</th>
                            <th class="mw-70 align-middle"> Kegiatan</th>
                            <th class="mw-70 align-middle"> Tujuan</th>
                            <th class="mw-70 align-middle"> Sasaran</th>
                            <th class="mw-70 align-middle"> Target Sasaran</th>
                            <th class="mw-70 align-middle"> Penanggung Jawab</th>
                            <th class="mw-70 align-middle"> Volume Kegiatan</th>
                            <th class="mw-70 align-middle"> Jadwal</th>
                            <th class="mw-70 align-middle"> Rincian Pelaksanaan</th>
                            <th class="mw-70 align-middle"> Lokasi Pelaksanaan</th>
                            <th class="mw-70 align-middle text-right"> Biaya</th>
                            <th class="mw-70 align-middle text-center"> Aksi</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($unit_puskesmas_list AS $unit_puskesmas)
                            <tr class="font-weight-bold">
                                <td colspan="13">
                                    {{ $unit_puskesmas->nama }}
                                </td>
                            </tr>

                            @php
                                $count = 0
                            @endphp

                            @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                                @foreach($upaya_kesehatan->item_rencana_pelaksanaan_kegiatan_tahunan_list AS $item)
                                    <tr>
                                        <td class="mw-70 text-center"> {{ ++$count }} </td>
                                        <td class="mw-70"> {{ $upaya_kesehatan->nama  }}  </td>
                                        <td class="mw-70"> {{ $item->kegiatan }} </td>
                                        <td class="mw-70"> {{ $item->tujuan }} </td>
                                        <td class="mw-70"> {{ $item->sasaran }} </td>
                                        <td class="mw-70"> {{ $item->target_sasaran }} </td>
                                        <td class="mw-70"> {{ $item->penanggung_jawab }} </td>
                                        <td class="mw-70"> {{ $item->volume_kegiatan }} </td>
                                        <td class="mw-70"> {{ $item->jadwal }} </td>
                                        <td class="mw-70"> {{ $item->rincian_pelaksanaan }} </td>
                                        <td class="mw-70"> {{ $item->lokasi_pelaksanaan }} </td>
                                        <td class="mw-70 text-right"> {{ \App\Support\Formatter::currency($item->biaya) }} </td>
                                        <td class="mw-70 text-center">
                                            <a href="{{ route("puskesmas.item-rpk-tahunan.edit", $item->id) }}"
                                               class="btn btn-dark btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <form class="d-inline-block"
                                                  action="{{ route('puskesmas.item-rpk-tahunan.destroy', $item->id) }}"
                                                  method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-outline-danger btn-sm"
                                                        type="submit">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
