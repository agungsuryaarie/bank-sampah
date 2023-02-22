<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
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
            <a href="{{ route('sampah.index') }}"
                class="nav-link {{ request()->segment(2) == 'sampah' ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Jenis Sampah
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('catatan.index') }}"
                class="nav-link {{ request()->segment(2) == 'catatan' ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Catatan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('transaksi.index') }}"
                class="nav-link {{ request()->segment(2) == 'transaksi' ? 'active' : '' }}">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                    Transaksi
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
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
