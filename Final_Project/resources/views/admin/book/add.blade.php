@extends('admin.layouts.app')

@push('plugin-styles')
    <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">
@endpush

@push('style')
    <style>
        #preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
            background-color: #f0f0f0;
            /* Light gray background */
            border-radius: 10px;
            /* Rounded corners */
            padding: 10px;
            /* Some padding inside the container */
        }

        .img-container {
            position: relative;
            margin-bottom: 15px;
            width: calc(33.33% - 10px);
            /* Default: 3 images per row */
        }

        .img-container img {
            width: 100%;
            height: 200px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .img-container {
                width: calc(50% - 10px);
                /* 2 images per row on tablets */
            }
        }

        @media (max-width: 480px) {
            .img-container {
                width: 100%;
                /* 1 image per row on small screens */
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-shopping-outline"></i>
            </span>
            books
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Tambah books
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah books</h4>
                <p class="card-description">Masukkan data secara lengkap</p>
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                            value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <input type="text" class="form-control" name="summary" id="summary" placeholder="summary"
                            value="{{ old('summary') }}">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="genre_id">genre</label>
                            <!-- Select2 Dropdown for Categories -->
                            <select id="category_select" name="genre_id" style="width: 100%">
                                <option value="">Pilih genre</option>
                                @foreach ($genres as $k)
                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder="0">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="image" class="col-form-label">Image</label>
                        </div>
                        <div class="col-lg-8">
                            <input class="form-control" name="image" id="image" type="file" accept="image/*"
                                required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#category_select').select2({
                tags: true, // Allow users to create new categories as tags
                placeholder: 'Pilih atau Buat genre Baru'
            });
        });

        function previewImages() {
            const input = document.getElementById('image');
            const files = input.files;
            const previewContainer = document.getElementById('preview-container');

            // Untuk memastikan gambar yang sudah ada tidak terhapus
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Membuat elemen gambar untuk preview
                        const imgContainer = document.createElement('div');
                        imgContainer.style.position = 'relative';
                        imgContainer.style.marginBottom = '15px';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-fluid');
                        img.style.height = '200px';
                        img.style.objectFit = 'cover';

                        // Tombol hapus gambar
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Hapus';
                        deleteButton.className = 'btn btn-danger btn-sm';
                        deleteButton.style.position = 'absolute';
                        deleteButton.style.top = '10px';
                        deleteButton.style.right = '10px';
                        deleteButton.onclick = function() {
                            imgContainer.remove();
                        };

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(deleteButton);
                        previewContainer.appendChild(imgContainer);
                    };

                    // Membaca gambar sebagai DataURL
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endpush
