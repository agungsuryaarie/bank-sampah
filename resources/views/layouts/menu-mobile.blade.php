@if (Auth::user()->type == 'nasabah')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row-menu shadow-lg">
                <div class="menu-responsive">
                    <a href="{{ route('nasabah.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('nasabah.penarikan') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transaksi</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('nasabah.hispenjualan') }}">
                        <i class="fa fa-history"></i>
                        <span>Histori Penjualan</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('nasabah.hispenarikan') }}">
                        <i class="fa fa-history"></i>
                        <span>Histori Penarikan</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('logout') }}">
                        <i class="fa fa-history"></i>
                        <span>Log Out</span></a>
                </div>
            </div>
        </div>
    </div>
@endif
