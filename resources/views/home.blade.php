@extends('layouts.app')

@section('content')
<div class="container">
    <rencana-pelaksanaan-kegiatan-tahunan-create
        :unit_puskesmas_list='{{ json_encode($unit_puskesmas_list) }}'
    ></rencana-pelaksanaan-kegiatan-tahunan-create>
</div>
@endsection
