<div>
    <h1 class="feature-title">
        Upaya Kesehatan
    </h1>

    <div>
        @if($upaya_kesehatan_list->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover">
                    <thead>
                    <tr>
                        <th> # </th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($upaya_kesehatan_list as $upaya_kesehatan)
                        <tr>
                            <td> {{ $upaya_kesehatan_lists->firstItem() + $loop->index }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $upaya_kesehatan_lists->links() }}
            </div>

        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ __("messages.errors.no_data") }}
            </div>
        @endif
    </div>
</div>
