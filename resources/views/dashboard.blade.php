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
                        @if (Auth::user()->type == 'admin')
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
                                            <canvas id="myChartPembelian" height="200"></canvas>
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
                                            <canvas id="myChartPenarikan" height="200"></canvas>
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
                                            <canvas id="myChartSampah" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Grafik Persentase Sampah Perbulan</h3>
                                            <a href="javascript:void(0);">View Report</a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-center">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select class="form-control select2bs4" style="width: 100%;">
                                                    <option selected="selected">Pilih Bulan</option>
                                                    <option>Januari</option>
                                                    <option>Februari</option>
                                                    <option>Maret</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="myChartSampahPerbulan" height="200"></canvas>
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

        // Line Chart Pembelian
        // setup 
        const dataPembelian = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Weekly Sales',
                data: [18, 12, 6, 9, 12, 3, 9, 31, 21, 51, 17, 11],
                borderColor: [
                    'rgb(75, 192, 192)',
                ],
                borderWidth: 2
            }]
        };

        // config 
        const configPembelian = {
            type: 'line',
            data: dataPembelian,
            options: {
                plugins: {
                    legend: {
                        display: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            }
        };

        // render init block
        const myChartPembelian = new Chart(
            document.getElementById('myChartPembelian'),
            configPembelian
        );

        // Line Chart Penarikan
        // setup
        const dataPenarikan = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Weekly Sales',
                data: [18, 12, 6, 9, 12, 3, 9, 31, 21, 51, 17, 11],
                borderColor: [
                    'rgba(255, 26, 104, 1)',
                ],
                borderWidth: 2
            }]
        };

        // config 
        const configPenarikan = {
            type: 'line',
            data: dataPenarikan,
            options: {
                plugins: {
                    legend: {
                        display: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            }
        };

        // render init block
        const myChartPenarikan = new Chart(
            document.getElementById('myChartPenarikan'),
            configPenarikan
        );


        // Pie chart Persentase Sampah
        // setup 
        const dataSampah = {
            labels: ['Kertas', 'Duplex', 'Kardus', 'Gelas Plastik', 'Botol Plastik', 'Plastik Non Botol',
                'Kaca', 'Kaleng/besi'
            ],
            datasets: [{
                label: 'Weekly Sales',
                data: [18, 12, 6, 9, 12, 3, 9],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(178, 164, 255)',
                    'rgb(14, 162, 147)',
                    'rgb(225, 18, 153)',
                    'rgb(25, 167, 206)'
                ],
                borderWidth: 1
            }]
        };

        // config 
        const configSampah = {
            type: 'pie',
            data: dataSampah,
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            }
        };

        // render init block
        const myChartSampah = new Chart(
            document.getElementById('myChartSampah'),
            configSampah
        );


        // bar chart grafik sampah perbulan
        // setup
        const dataSampahPerbulan = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Weekly Sales',
                data: [18, 23, 14, 61, 23, 42, 16, 19, 70, 91, 12, 89],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 1,
            }]
        };

        // config 
        const configSampahPerbulan = {
            type: 'bar',
            data: dataSampahPerbulan,
            options: {
                plugins: {
                    legend: {
                        display: false,
                        position: 'bottom',
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            }
        };

        // render init block
        const myChartSampahPerbulan = new Chart(
            document.getElementById('myChartSampahPerbulan'),
            configSampahPerbulan
        );
    </script>
@endsection
