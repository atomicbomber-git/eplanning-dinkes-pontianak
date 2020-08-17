<div class="container">
    <h1 class="feature-title">
        Puskesmas
    </h1>

    <x-messages></x-messages>

    <div class="d-flex justify-content-end my-3">
        <a href="{{ route("puskesmas-for-admin.create") }}" class="btn btn-primary">
            Tambah
            <i class="fas fa-plus"></i>
        </a>
    </div>

    @if($this->puskesmasList->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-sm table-striped table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Nama Puskesmas </th>
                    <th> Nama Admin </th>
                    <th> Nama Pengguna Admin </th>
                    <th> Alamat </th>
                    <th class="text-center"> Kendali </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($this->puskesmasList as $puskesmas)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $puskesmas->nama }} </td>
                        <td> {{ $puskesmas->user->name }} </td>
                        <td> {{ $puskesmas->user->username }} </td>
                        <td> {{ $puskesmas->alamat }} </td>
                        <td class="text-center">
                            <a href="{{ route("puskesmas-for-admin.edit", $puskesmas) }}" class="btn btn-primary btn-sm">
                                Ubah
                                <i class="fas fa-pencil-alt  "></i>
                            </a>

                            <button
                                    x-data="{}"
                                    x-on:click="
                                    window.confirmDialog()
                                        .then(response => {
                                            if (response.value) {
                                                window.livewire.emit('puskesmas:delete', {{ $puskesmas->id }})
                                            }
                                        })"
                                    class="btn btn-sm btn-danger">
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
            {{ $this->puskesmasList->links() }}
        </div>

    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            {{ __("messages.no_data") }}
        </div>
    @endif
</div>
