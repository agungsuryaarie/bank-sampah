@extends('layouts.app')

@section('content')
    @include('layouts.menu-mobile')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'pengurus' || Auth::user()->type == 'bendahara')
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Grafik Transaksi Pembelian</h3>
                                            <a href="javascript:void(0);">View Report</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="myChartPembelian" height="100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Grafik Transaksi Penarikan Saldo</h3>
                                            <a href="javascript:void(0);">View Report</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="myChartPenarikan" height="100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Grafik Persentase Sampah</h3>
                                            <a href="javascript:void(0);">View Report</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="myChartSampah" height="270"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Grafik Sampah Perbulan</h3>
                                            <a href="javascript:void(0);">View Report</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="myChartSampahPerbulan" height="100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        @if (Auth::user()->type == 'nasabah')
                            <div class="card-body">
                                <div class="row-card">
                                    <div class="col-lg-6 col-12">
                                        <div class="card-box bg-info">
                                            <div class="inner">
                                                <h5>Pemilik</h5>
                                                <hr>
                                                <p>Nama : {{ Auth::user()->name }}</p>
                                                <p>Email : {{ Auth::user()->email }}</p>
                                                <p>Telephone : {{ Auth::user()->nohp }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="card-box bg-info">
                                            <div class="inner">
                                                <h5>Tabungan</h5>
                                                <hr>
                                                <p>Total Debit : Rp {{ $debit }}</p>
                                                <p>Total Kredit : Rp {{ $kredit }}</p>
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
                                            <table id="data-table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th>Keterangan</th>
                                                        <th>Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
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
    <script>
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
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    }
                ]
            })
        })
    </script>

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        @if (Auth::user()->type == 'admin')

            $(document).ready(function() {
                $.ajax({
                    url: 'dashboard/data',
                    method: 'GET',
                    success: function(data) {
                        var ctxPembelian = document.getElementById('myChartPembelian').getContext('2d');
                        var myChartPembelian = new Chart(ctxPembelian, {
                            type: 'line',
                            data: {
                                labels: data.labelPembelian,
                                datasets: [{
                                    label: 'Pembelian Perbulan',
                                    data: data.dataPembelian,
                                    fill: false,
                                    borderColor: 'rgba(255, 99, 132, 0.8)',
                                    borderWidth: 2
                                }]
                            }
                        });

                        var ctxPenarikan = document.getElementById('myChartPenarikan').getContext('2d');
                        var myChartPenarikan = new Chart(ctxPenarikan, {
                            type: 'line',
                            data: {
                                labels: data.labelPenarikan,
                                datasets: [{
                                    label: 'Penarikan Perbulan',
                                    data: data.dataPenarikan,
                                    fill: false,
                                    borderColor: 'rgba(255, 99, 132, 0.8)',
                                    borderWidth: 2
                                }]
                            }
                        });

                        var ctxPersenSampah = document.getElementById('myChartSampah').getContext('2d');
                        var myChartPersenSampah = new Chart(ctxPersenSampah, {
                            type: 'pie',
                            data: {
                                labels: data.labelSampah,
                                datasets: [{
                                    label: 'Persentase',
                                    data: data.dataSampah,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(255, 206, 86, 0.8)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                            }
                        });

                        var ctxSampahPerbulan = document.getElementById('myChartSampahPerbulan')
                            .getContext('2d');
                        var myChartSampahPerbulan = new Chart(ctxSampahPerbulan, {
                            type: 'bar',
                            data: {
                                labels: data.labelSampahBar,
                                datasets: [{
                                    label: 'Total Berat Kg',
                                    data: data.dataSampahBar,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(255, 206, 86, 0.8)',
                                    ],
                                    borderWidth: 1
                                }]
                            }
                        });
                    }
                });
            });
        @endif
    </script>
@endsection
