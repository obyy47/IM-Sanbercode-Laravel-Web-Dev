@push('style')
    <style>
        #suggestions-box {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-top: none;
            background-color: #fff;
        }

        #suggestions-box .list-group-item {
            cursor: pointer;
        }

        #suggestions-box .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
@endpush

<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" style="height: 50px;">
        </a>

        <!-- Button Toggler untuk responsive menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas Navbar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Kategori Dropdown -->



                <!-- Akun dan Keranjang -->
                <ul class="navbar-nav d-flex align-items-center">
                    <!-- Wishlist -->
                    <li class="nav-item">
                        <a href="/user/produk" class="nav-link text-dark" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Produk">
                            <i class="mdi mdi-store-outline"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Wishlist">
                            <i class="mdi mdi-heart"></i>
                        </a>
                    </li>

                    @auth
                        <!-- Keranjang -->
                        <li class="nav-item me-3">
                            <a href="#" class="nav-link text-dark" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart" id="cartTooltip"
                                title="Keranjang">
                                <i class="mdi mdi-cart"></i>
                            </a>
                        </li>

                        <!-- Akun -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="me-2 icon-md" data-feather="user"></i>{{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="mdi mdi-cached me-2 text-success"></i> Order Saya
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-account me-2 text-success"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="mdi mdi-logout me-2 text-primary"></i> SignOut
                                </a>
                            </div>
                        </li>
                    @endauth

                    <!-- Login/Signup (Tampilkan jika belum login) -->
                    @guest
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-primary">Sign Up</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

@auth
    <!-- Offcanvas Cart -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart"
        aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Keranjang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if ($cart && $cart->items->count())
                <ul class="list-group mb-3">
                    @foreach ($cart->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->produk->namaproduk }} x {{ $item->quantity }}
                            <span>Rp {{ number_format($item->produk->harga * $item->quantity, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('checkout.detail') }}" class="btn btn-primary">Checkout</a>
            @else
                <p>Keranjang Anda kosong.</p>
            @endif
        </div>
    </div>
@endauth

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi semua tooltip yang menggunakan data-bs-toggle="tooltip"
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Tooltip untuk keranjang (manual karena tidak ada data-bs-toggle="tooltip" di HTML)
            var cartTooltipEl = document.getElementById('cartTooltip');
            var cartTooltip = new bootstrap.Tooltip(cartTooltipEl);

            var offcanvasCart = document.getElementById('offcanvasCart');

            offcanvasCart.addEventListener('show.bs.offcanvas', function() {
                cartTooltip.hide(); // Hilangkan tooltip saat offcanvas dibuka
            });

            offcanvasCart.addEventListener('hidden.bs.offcanvas', function() {
                cartTooltip.show(); // Tampilkan tooltip lagi setelah offcanvas ditutup
            });
        });



        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                const query = $(this).val();
                if (query.length > 1) { // Hanya mulai mencari jika lebih dari 2 karakter
                    $.ajax({
                        url: "",
                        type: "GET",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            let suggestions = '';
                            if (data.length > 0) {
                                data.forEach(item => {
                                    suggestions +=
                                        `<a href="/produk/${item.id}" class="list-group-item list-group-item-action">${item.namaproduk}</a>`;
                                });
                            } else {
                                suggestions =
                                    '<div class="list-group-item">Tidak ada hasil ditemukan</div>';
                            }
                            $('#suggestions-box').html(suggestions).show();
                        }
                    });
                } else {
                    $('#suggestions-box').hide(); // Sembunyikan box jika input kosong
                }
            });

            // Sembunyikan saran jika klik di luar
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-input, #suggestions-box').length) {
                    $('#suggestions-box').hide();
                }
            });
        });
    </script>
@endpush
