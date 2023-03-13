@if (Auth::user()->type == 'nasabah')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row-menu shadow-lg">
                <div class="menu-responsive">
                    <a href="{{ route('keuangan.penjualan') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('keuangan.penjualan') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Penarikan</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('keuangan.penjualan') }}">
                        <i class="fa fa-history"></i>
                        <span>Histori Penjualan</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('keuangan.penjualan') }}">
                        <i class="fa fa-history"></i>
                        <span>Histori Penarikan</span></a>
                </div>
                <div class="menu-responsive">
                    <a href="{{ route('keuangan.penjualan') }}">
                        <i class="fa fa-history"></i>
                        <span>Log Out</span></a>
                </div>
            </div>
        </div>
    </div>
@endif
