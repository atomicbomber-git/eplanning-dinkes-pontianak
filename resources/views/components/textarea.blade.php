@props([
    'value',
    'label' => 'Label',
    'field' => 'field',
])

<div class="form-group">
    <label for="{{ $field  }}"> {{ $label }}: </label>
    <textarea
        {{ $attributes }}
        id="{{ $field  }}"
        placeholder="{{ $label }}"
        class="form-control @error($field) is-invalid @enderror"
        name="{{ $field  }}"
    >{{ old($field, $value ?? null) }}</textarea>
    @error($field)
    <span class="invalid-feedback">
        {{ $message }}
    </span>
    @enderror
</div>
