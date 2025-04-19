<nav class="sidebar sidebar-offcanvas " id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Books</span>
                <i class="mdi mdi-shopping-outline menu-icon"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/book') }}">Data Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/book/add') }}">Add Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/genre') }}">Genre Books</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
