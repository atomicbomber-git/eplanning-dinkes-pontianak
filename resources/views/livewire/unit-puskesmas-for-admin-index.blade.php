<div class="container">
    <h1 class="feature-title">
        Unit Puskesmas
    </h1>

    <div>
        @if($unit_puskesmas_list->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Nama </th>
                        <th> Kendali </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($unit_puskesmas_list as $unit_puskesmas)
                        <tr>
                            <td> {{ $unit_puskesmas_list->firstItem() + $loop->index }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $unit_puskesmas_list->links() }}
            </div>

        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ __("messages.errors.no_data") }}
            </div>
        @endif
    </div>
</div>
