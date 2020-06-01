@extends("layouts.app")

@section("content")
    <div class="container">
        <h1> Tambah Rencana Pelaksanaan Kegiatan Tahunan </h1>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                @include("layouts._messages")

                <form method="POST"
                      action="{{ route("puskesmas.rpk-tahunan.store") }}">
                    @csrf

                    <x-input
                        field="tahun"
                        label="Tahun"
                        type="number"
                        step="1"
                    ></x-input>

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
