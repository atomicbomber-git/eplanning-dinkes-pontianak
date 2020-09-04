<div class="container">
    <h1 class="feature-title">
        Puskesmas
    </h1>

    <x-messages></x-messages>

    <div class="d-flex justify-content-end my-3">
        <a href="{{ route("puskesmas-for-admin.create") }}" class="btn btn-dark">
            Tambah
        </a>
    </div>

    @if($this->puskesmasList->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th class="align-middle"> # </th>
                    <th class="align-middle"> Nama Puskesmas </th>
                    <th class="align-middle"> Nama Admin </th>
                    <th class="align-middle"> Nama Pengguna Admin </th>
                    <th class="align-middle" style="width: 200px"> Alamat </th>
                    <th class="align-middle text-center"> Kendali </th>
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
                            <a href="{{ route("puskesmas-for-admin.edit", $puskesmas) }}" class="btn btn-dark">
                                Ubah
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
            {{ $this->puskesmasList->links() }}
        </div>

    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            {{ __("messages.errors.no_data") }}
        </div>
    @endif
</div>
