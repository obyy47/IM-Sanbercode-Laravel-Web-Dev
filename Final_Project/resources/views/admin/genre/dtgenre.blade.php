@extends('admin.layouts.app')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-shopping-outline"></i>
            </span>
            Books
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Genre
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Books</h6>
                    <div class="mb-4">
                        <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal"
                            data-bs-target="#tambahdata">
                            <i class="mdi mdi-plus icon-sm align-middle"></i> genre Baru
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="DTgenrebooks" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>genre</th>
                                    <th>Deskripsi</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($genre as $k)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $k->name }}</td>

                                        <td>{{ $k->description }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modaledit{{ $k->id }}">
                                                            <i class="mdi mdi-square-edit-outline me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form id="delete-form-{{ $k->id }}"
                                                            action="{{ route('genre.delete', $k->id) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <a class="dropdown-item text-danger" href="#"
                                                            onclick="confirmDelete({{ $k->id }})">
                                                            <i class="mdi mdi-delete me-2"></i> Hapus
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal untuk Tambah Data -->
    <div class="modal fade" id="tambahdata" aria-labelledby="tambahdataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-white rounded shadow-sm"> <!-- Container putih dan ada shadow -->
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modaleditLabel">Buat genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('genre.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="genre_books">Nama genre</label>
                            <input type="text" class="form-control w-100" name="name" id="name"
                                placeholder="Nama genre" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">description</label>
                            <input type="text" class="form-control w-100" name="description" id="description"
                                placeholder="description" value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="genreimgModal" tabindex="-1" role="dialog" aria-labelledby="genreimgModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="genreimgModalLabel">Gambar books</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Gambar yang akan ditampilkan -->
                </div>
            </div>
        </div>
    </div>

    @foreach ($genre as $k)
        <div class="modal fade" id="modaledit{{ $k->id }}" aria-labelledby="modaleditLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-white rounded shadow-sm">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title" id="modaleditLabel">Edit genre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('genre.update', $k->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Nama genre</label>
                                <input type="text" class="form-control w-100" name="name" id="name"
                                    value="{{ $k->name }}">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">description</label>
                                <input type="text" class="form-control w-100" name="description" id="description"
                                    value="{{ $k->description }}">
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="form-group mb-3">
                                <label for="gambar_genre">Gambar genre</label>
                                <input type="file" name="gambar_genre" id="gambar_genre" class="form-control w-100">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                                @error('gambar_genre')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function() {

            var table = $('#DTgenrebooks').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,

                // Aktifkan responsif
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }

            // window.showImages = function(gambar_genre) {
            //     const modalBody = document.getElementById('modalBody');

            //     // Check if modalBody exists
            //     if (!modalBody) {
            //         console.error("Modal body element not found!");
            //         return;
            //     }

            //     // Ensure gambar_genre is an array
            //     if (!Array.isArray(gambar_genre)) {
            //         gambar_genre = [
            //             gambar_genre
            //         ]; // If it's not an array, make it one (assuming it's a single image)
            //     }

            //     modalBody.innerHTML = ''; // Reset modal body

            //     // Loop through each image and create an image element
            //     gambar_genre.forEach(image => {
            //         const imgElement = document.createElement('img');
            //         imgElement.src = `/storage/${image}`; // Set the image source
            //         imgElement.classList.add('img-fluid'); // Make sure the image fits within the modal
            //         imgElement.alt = "Gambar books";

            //         // Append the image element to the modal body
            //         modalBody.appendChild(imgElement);
            //     });

            //     // Show the modal manually
            //     const modal = new bootstrap.Modal(document.getElementById('genreimgModal'));
            //     modal.show();
            // };


            // // Ensure the backdrop is removed when the modal is closed
            // const modalElement = document.getElementById('genreimgModal');
            // modalElement.addEventListener('hidden.bs.modal', function() {
            //     const backdrop = document.querySelector('.modal-backdrop');
            //     if (backdrop) {
            //         backdrop.remove();
            //     }
            // });
        });
    </script>
@endpush
