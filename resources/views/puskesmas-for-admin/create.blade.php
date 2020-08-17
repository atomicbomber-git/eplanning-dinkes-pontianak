@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="feature-title">
            <a href="{{ route("puskesmas-for-admin.index") }}">
                Puskesmas
            </a>

            /

            Tambah
        </h1>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route("puskesmas-for-admin.store") }}">
                    @csrf

                    <div class="form-group">
                        <label for="nama"> Nama Puskesmas: </label>
                        <input
                                id="nama"
                                type="text"
                                placeholder="Nama Puskesmas"
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

                    <div class="form-group">
                        <label for="alamat"> Alamat Puskesmas: </label>
                        <textarea
                                id="alamat"
                                type="text"
                                placeholder="Alamat Puskesmas"
                                class="form-control @error("alamat") is-invalid @enderror"
                                name="alamat"
                        >{{ old("alamat") }}</textarea>
                        @error("alamat")
                        <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username"> Nama Pengguna Admin: </label>
                        <input
                                id="username"
                                type="text"
                                placeholder="Nama Pengguna Admin"
                                class="form-control @error("username") is-invalid @enderror"
                                name="username"
                                value="{{ old("username") }}"
                        />
                        @error("username")
                        <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name"> Nama Asli Admin: </label>
                        <input
                                id="name"
                                type="text"
                                placeholder="Nama Asli Admin"
                                class="form-control @error("name") is-invalid @enderror"
                                name="name"
                                value="{{ old("name") }}"
                        />
                        @error("name")
                        <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password"> Kata Sandi: </label>
                        <input
                                id="password"
                                type="password"
                                placeholder="Kata Sandi"
                                class="form-control @error("password") is-invalid @enderror"
                                name="password"
                                value="{{ old("password") }}"
                        />
                        @error("password")
                        <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"> Ulangi Kata Sandi: </label>
                        <input
                                id="password_confirmation"
                                type="password"
                                placeholder="Ulangi Kata Sandi"
                                class="form-control @error("password_confirmation") is-invalid @enderror"
                                name="password_confirmation"
                                value="{{ old("password_confirmation") }}"
                        />
                        @error("password_confirmation")
                        <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                        @enderror
                    </div>

                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection