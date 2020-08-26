<div class="container">
    <h1 class="feature-title">
        Unit Puskesmas
    </h1>

    <div class="d-flex justify-content-center py-3">
        <div class="flex-fill">

        </div>

        <div class="ml-3">
            <a href="{{ route("unit-puskesmas-for-admin.create") }}"
               class="btn btn-dark"
            >
                Tambah
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <x-messages></x-messages>

    <div>
        @if($unit_puskesmas_list->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th> # </th>
                        <th> Nama </th>
                        <th class="text-center"> Kendali </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($unit_puskesmas_list as $unit_puskesmas)
                        <tr>
                            <td> {{ $unit_puskesmas_list->firstItem() + $loop->index }} </td>
                            <td> {{ $unit_puskesmas->nama }} </td>
                            <td class="text-center">
                                <a href="{{ route("unit-puskesmas-for-admin.upaya-kesehatan.index", $unit_puskesmas) }}" class="btn btn-dark btn-sm">
                                    Upaya Kesehatan
                                </a>

                                <a href="{{ route("unit-puskesmas-for-admin.edit", $unit_puskesmas) }}" class="btn btn-dark btn-sm">
                                    Ubah
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button
                                        x-data="{}"
                                        x-on:click="
                                        window.confirmDialog()
                                            .then(response => {
                                                if (response.value) {
                                                    window.livewire.emit('unit-puskesmas:delete', {{ $unit_puskesmas->id }})
                                                }
                                            })"
                                        class="btn btn-danger btn-sm"
                                >
                                    Hapus
                                    <i class="fas fa-trash  "></i>
                                </button>
                            </td>
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
