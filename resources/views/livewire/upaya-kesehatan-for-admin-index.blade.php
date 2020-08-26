<div class="container">
    <h1 class="feature-title">
        <a href="{{ route("unit-puskesmas-for-admin.index") }}">
            Unit Puskesmas
        </a>

        /

        {{ $unit_puskesmas->nama }}

        /

        Upaya Kesehatan
    </h1>

    <div>
        @if($upaya_kesehatan_list->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th> # </th>
                        <th> Nama </th>
                        <th> Kendali </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($upaya_kesehatan_list as $upaya_kesehatan)
                        <tr>
                            <td> {{ $upaya_kesehatan_list->firstItem() + $loop->index }} </td>
                            <td> {{ $upaya_kesehatan->nama }} </td>
                            <td> Kendali </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $upaya_kesehatan_list->links() }}
            </div>

        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ __("messages.errors.no_data") }}
            </div>
        @endif
    </div>
</div>
