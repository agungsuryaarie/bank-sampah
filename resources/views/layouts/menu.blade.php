<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route(Auth::user()->type . '.dashboard') }}"
                class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        @if (Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('user.index') }}"
                    class="nav-link {{ request()->segment(2) == 'user' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
        @endif

        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'bendahara' || Auth::user()->type == 'pengurus')
            <li class="nav-item">
                <a href="{{ route(Auth::user()->type . '.nasabah.index') }}"
                    class="nav-link {{ request()->segment(2) == 'nasabah' ? 'active' : '' }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Nasabah
                    </p>
                </a>
            </li>
        @endif

        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'bendahara' || Auth::user()->type == 'pengurus')
            <li class="nav-item">
                <a href="{{ route(Auth::user()->type . '.sampah.index') }}"
                    class="nav-link {{ request()->segment(2) == 'sampah' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Jenis Sampah
                    </p>
                </a>
            </li>
        @endif

        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'bendahara' || Auth::user()->type == 'pengurus')
            <li class="nav-item">
                <a href="{{ route(Auth::user()->type . '.transaksi.index') }}"
                    class="nav-link {{ request()->segment(2) == 'transaksi' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p>
                        Transaksi
                    </p>
                </a>
            </li>
        @endif

        @if (Auth::user()->type == 'nasabah')
            <li class="nav-item">
                <a href="{{ route('nasabah.transaksi') }}"
                    class="nav-link {{ request()->segment(2) == 'transaksi' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p>
                        Transaksi
                    </p>
                </a>
            </li>
        @endif

        @if (Auth::user()->type == 'nasabah')
            <li class="nav-item">
                <a href="{{ route('nasabah.penjualan') }}"
                    class="nav-link {{ request()->segment(2) == 'penjualan' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                    <p>
                        Histori Penjualan
                    </p>
                </a>
            </li>
        @endif
        @if (Auth::user()->type == 'nasabah')
            <li class="nav-item">
                <a href="{{ route('nasabah.penarikan') }}"
                    class="nav-link {{ request()->segment(2) == 'penarikan' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                    <p>
                        Histori Penarikan
                    </p>
                </a>
            </li>
        @endif


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
