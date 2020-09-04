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

    <div class="d-flex justify-content-center py-3">
        <div class="flex-fill">

        </div>

        <div class="ml-3">
            <a href="{{ route("unit-puskesmas-for-admin.upaya-kesehatan.create", $unitPuskesmasId) }}"
               class="btn btn-dark"
            >
                Tambah
            </a>
        </div>
    </div>

    @include("components.messages")

    <div>
        @if($upaya_kesehatan_list->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th class="align-middle"> # </th>
                        <th class="align-middle"> Nama </th>
                        <th class="align-middle text-center"> Kendali </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($upaya_kesehatan_list as $upaya_kesehatan)
                        <tr>
                            <td> {{ $upaya_kesehatan_list->firstItem() + $loop->index }} </td>
                            <td> {{ $upaya_kesehatan->nama }} </td>
                            <td class="text-center">
                                <a href="{{ route("upaya-kesehatan.edit", $upaya_kesehatan) }}" class="btn btn-dark">
                                    Ubah
                                </a>

                                <button
                                        x-data="{}"
                                        x-on:click="
                                        window.confirmDialog()
                                            .then(response => {
                                                if (response.value) {
                                                        window.livewire.emit('upaya-kesehatan:delete', {{ $upaya_kesehatan->id }})
                                                }
                                            })"
                                        class="btn btn-danger">
                                    Hapus
                                </button>
                            </td>
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
