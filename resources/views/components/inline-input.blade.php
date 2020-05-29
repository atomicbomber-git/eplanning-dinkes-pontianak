@props([
    'array_name',
    'row_id',
    'item',
    'field',
])

<label
    class="d-none"
    for="{{ $field }}_{{ $rowId }}"></label>
<input
    id="{{ $field }}_{{ $rowId }}"
    placeholder="{{ $attributes["placeholder"] ?? 'Placeholder' }}"
    class="form-control form-control-sm rlt-textarea @error("{$arrayName}.{$rowId}.{$field}") is-invalid @enderror "
    name="{{ $arrayName }}[{{ $rowId }}][{{ $field }}]"
    value="{{
        isset($item) ?
            old("{$arrayName}.{$rowId}.{$field}", $item->$field) :
            old("{$arrayName}.{$rowId}.{$field}")
}}"
    {{ $attributes }}
>
@error("{$arrayName}.{$rowId}.{$field}")
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
