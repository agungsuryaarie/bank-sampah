<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->segment(1) == '/' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link {{ request()->segment(2) == 'user' ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    User
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('nasabah.index') }}"
                class="nav-link {{ request()->segment(2) == 'nasabah' ? 'active' : '' }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Nasabah
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jenis.index') }}"
                class="nav-link {{ request()->segment(1) == 'jenissampah' ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Jenis Sampah
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('catatan.index') }}"
                class="nav-link {{ request()->segment(1) == 'catatan' ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Catatan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('penjualan.index') }}"
                class="nav-link {{ request()->segment(1) == 'penjualan' ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Penjualan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('keuangan.index') }}"
                class="nav-link {{ request()->segment(1) == 'keuangan' ? 'active' : '' }}">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                    Keuangan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>
