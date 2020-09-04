@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("unit-puskesmas-for-admin.upaya-kesehatan.index", $upaya_kesehatan->unit_puskesmas->id) }}">
                {{ $upaya_kesehatan->unit_puskesmas->nama }}
            </a>

            /

            {{ $upaya_kesehatan->nama }}

            /

            Ubah
        </h1>

        <x-messages></x-messages>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ route("upaya-kesehatan.update", $upaya_kesehatan) }}"
                      method="POST"
                >
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                        <label for="nama"> Nama: </label>
                        <input
                                id="nama"
                                type="text"
                                placeholder="Nama"
                                class="form-control @error("nama") is-invalid @enderror"
                                name="nama"
                                value="{{ old("nama", $upaya_kesehatan->nama) }}"
                        />
                        @error("nama")
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
@endsection