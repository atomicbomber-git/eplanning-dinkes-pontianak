@props([
    'value',
    'label' => 'Label',
    'field' => 'field',
])

<div class="form-group">
    <label for="{{ $field  }}"> {{ $label }}: </label>
    <input
        {{ $attributes }}
        id="{{ $field  }}"
        placeholder="{{ $label }}"
        class="form-control @error($field) is-invalid @enderror"
        name="{{ $field  }}"
        value="{{ old($field, $value ?? null) }}"
    />
    @error($field)
    <span class="invalid-feedback">
        {{ $message }}
    </span>
    @enderror
</div>
