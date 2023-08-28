<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" @stack('menu') href="{{ url('dashboard') }}">
                <i class="bi bi-house menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
            
        </li>
        <li class="nav-item">
            <a class="nav-link" @stack('menu') href="{{ url('back/user') }}">
                <i class="bi bi-person-fill menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
        @if (Auth::user()->role == 'Admin')
            <li class="nav-item">
                <a class="nav-link" @stack('menu') href="{{ url('back/slider') }}">
                    <i class="bi bi-images menu-icon"></i>
                    <span class="menu-title">Slider</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ url('back/product') }}">
                <i class="bi bi-box-seam menu-icon"></i>
                <span class="menu-title">Produk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @stack('menu') href="{{ url('back/beritas') }}">
                <i class="bi bi-newspaper menu-icon"></i>
                <span class="menu-title">Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @stack('menu') href="{{ url('back/diskusi-produk') }}">
                <i class="bi bi-chat-right-text menu-icon"></i>
                <span class="menu-title">Diskusi Produk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @stack('menu') href="{{ url('back/diskusi-berita') }}">
                <i class="bi bi-chat-right-text menu-icon"></i>
                <span class="menu-title">Diskusi Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('back/cart') }}">
                <i class="bi bi-cart menu-icon"></i>
                <span class="menu-title">Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('back/tagihan') }}">
                <i class="bi bi-receipt menu-icon"></i>
                <span class="menu-title">Tagihan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('back/visitor') }}">
                <i class="bi bi-bar-chart menu-icon"></i>
                <span class="menu-title">Visitor</span>
            </a>
        </li>
    </ul>
</nav>
