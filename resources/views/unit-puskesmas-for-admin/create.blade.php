@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("unit-puskesmas-for-admin.index") }}">
                Unit Puskesmas
            </a>

            /

            Tambah
        </h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route("unit-puskesmas-for-admin.store") }}"
                      method="POST"
                      enctype="multipart/form-data"
                >
                    @csrf
                    @method("POST")

                    <div class="form-group">
                        <label for="nama"> Nama: </label>
                        <input
                                id="nama"
                                type="text"
                                placeholder="Nama"
                                class="form-control @error("nama") is-invalid @enderror"
                                name="nama"
                                value="{{ old("nama") }}"
                        />
                        @error("nama")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection