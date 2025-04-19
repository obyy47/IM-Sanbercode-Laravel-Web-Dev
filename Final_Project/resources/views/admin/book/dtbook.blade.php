@extends('admin.layouts.app')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('style')
    <style>

    </style>
@endpush

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-shopping-outline"></i>
            </span>
            book
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Data book
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">book</h6>
                    <div class="table-responsive">
                        <table id="DTbook" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Summary</th>
                                    <th>Stock</th>
                                    <th>Genre</th>
                                    <th>Gambar book</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->summary }}</td>
                                        <td>{{ $book->stock }}</td>
                                        <td>{{ $book->genre->name }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalGambar"
                                                data-img-src="{{ asset('storage/' . $book->image) }}">
                                                <img src="{{ asset('storage/' . $book->image) }}" alt="Bukti Pembayaran"
                                                    width="100">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editbookModal{{ $book->id }}">
                                                            <i class="mdi mdi-storefront-edit-outline me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form id="delete-form-{{ $book->id }}"
                                                            action="{{ route('books.delete', $book->id) }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <a class="dropdown-item text-danger" href="#"
                                                            onclick="confirmDelete({{ $book->id }})">
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
    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Gambar book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" id="modalBody">
                    <!-- Gambar yang akan ditampilkan -->

                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit book -->
    @foreach ($books as $p)
        <div class="modal fade" id="editbookModal{{ $p->id }}" aria-labelledby="editbookModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-white rounded shadow-sm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editbookModalLabel">Edit book</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('books.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Nama book</label>
                                <input type="text" class="form-control" name="title" value="{{ $p->title }}">
                            </div>
                            <div class="form-group">
                                <label for="summary">summary</label>
                                <input type="text" class="form-control" name="summary" value="{{ $p->summary }}">
                            </div>
                            <div class="form-group">
                                <label for="genre_id">genre</label>
                                <select id="genre_id" name="genre_id" class="form-control select2" style="width: 100%">
                                    @foreach ($genres as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $p->genre_id == $k->id ? 'selected' : '' }}>{{ $k->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stock">stock</label>
                                <input type="number" class="form-control" name="stock" value="{{ $p->stock }}">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Buku Saat Ini</label><br>
                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="cover" width="120"
                                        class="img-thumbnail mb-2">
                                @else
                                    <p class="text-muted">Belum ada gambar</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Ganti Gambar Buku</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        var table = $('#DTbook').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,

            // Aktifkan responsif
        });
        $(document).on('shown.bs.modal', function(e) {
            const modal = $(e.target);
            $(e.target).find('.select2').select2({
                dropdownParent: $(e.target),
                width: '100%', // Ensures that the select2 input width is responsive
                dropdownAutoWidth: true, // Adjusts the width of the dropdown based on the input width
            });
        });

        // Function to show images in the carousel inside the modal
        function showImages(image) {
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = ''; // Reset modal body

            // Create the carousel structure
            let carouselHTML = `
            <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="carouselImages">
                    <!-- Images will be dynamically added here -->
                </div>
                <a class="carousel-control-prev" href="#bookCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bookCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        `;

            modalBody.innerHTML = carouselHTML; // Add the carousel structure to the modal body

            const carouselInner = document.getElementById('carouselImages');

            image.forEach((image, index) => {
                const activeClass = index === 0 ? 'active' : ''; // Set the first image as active

                const imageItem = `
                <div class="carousel-item ${activeClass}">
                    <img src="/storage/${image}" class="d-block w-100" alt="Gambar book">
                </div>
            `;
                carouselInner.innerHTML += imageItem; // Add each image to the carousel
            });

            // Show the modal manually
            const modal = new bootstrap.Modal(document.getElementById('bookModal'));
            modal.show();
        }

        // Ensure the backdrop is removed when the modal is closed
        const modalElement = document.getElementById('bookModal');
        modalElement.addEventListener('hidden.bs.modal', function() {
            // Manually remove the modal backdrop if it's still there
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
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
    </script>
@endpush
