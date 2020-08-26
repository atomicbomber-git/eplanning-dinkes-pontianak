@extends("layouts.app")

@section("content")
    <livewire:upaya-kesehatan-for-admin-index
            unit_puskesmas_id="{{ $unit_puskesmas->id }}"
    />
@endsection