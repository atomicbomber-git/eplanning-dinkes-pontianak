@props([
    'unit_puskesmas_list',
    'upaya_kesehatan_id'
])

<div class="form-group">
    <label for="upaya_kesehatan_id">
        Upaya Kesehatan:
    </label>

    <select
        class="select_upaya_kesehatan_id form-control form-control-sm @error("upaya_kesehatan_id") is-invalid @enderror"
        name="upaya_kesehatan_id"
        id="upaya_kesehatan_id">

        @foreach($unitPuskesmasList AS $unit_puskesmas)
            @foreach($unit_puskesmas->upaya_kesehatan_list AS $upaya_kesehatan)
                <option
                    {{ old("upaya_kesehatan_id", $upayaKesehatanId ?? null) === $upaya_kesehatan->id ? "selected" : ""  }}
                    value="{{ $upaya_kesehatan->id }}">
                    {{ $unit_puskesmas->nama }} - {{ $upaya_kesehatan->nama }}
                </option>
            @endforeach
        @endforeach
    </select>
    @error("upaya_kesehatan_id")
    <span class="invalid-feedback">
        {{ $message }}
    </span>
    @enderror

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".select_upaya_kesehatan_id").select2()
            })
        </script>
    @endpush
</div>
