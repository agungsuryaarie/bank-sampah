@extends('layouts.app')

@section('content')
    @include('layouts.menu-mobile')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (Auth::user()->type == 'nasabah')
                            <div class="card-body">
                                <div class="row-card">
                                    <div class="col-lg-6 col-12">
                                        <div class="card-box bg-info">
                                            <div class="inner">
                                                <h5>Pemilik</h5>
                                                <hr>
                                                <p>Nama : </p>
                                                <p>Email :</p>
                                                <p>Telephone :</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="card-box bg-info">
                                            <div class="inner">
                                                <h5>Tabungan</h5>
                                                <hr>
                                                <p>Total Debit : Rp {{ $saldo->saldo }}</p>
                                                <p>Total Kredit : Rp 0</p>
                                                <p>Saldo Akhir : Rp {{ $saldo->saldo }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice p-3 mb-3">
                                    <div class="card-header ">
                                        <h3 class="card-header-title text-center">Riwayat Transaksi</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>23 Maret 2023</td>
                                                        <td>Penarikan Saldo</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    {{-- <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var table = $("#data-table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                ajax: "{{ route(Auth::user()->type . '.dashboard') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'sampah',
                        name: 'sampah'
                    },
                    {
                        data: 'berat',
                        name: 'berat'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },
                    {
                        data: 'petugas',
                        name: 'petugas'
                    },
                ]
            })
        })
    </script> --}}
@endsection
