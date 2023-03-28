@extends('layouts.app')


@section('content')
    @include('layouts.menu-mobile')
    <div class="content-header"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row-flex">
                <div class="col-lg-10 col-md-12 ">
                    <div class="invoice p-3 mb-3">
                        <div class="card-header ">
                            <h3 class="card-header-title text-center">{{ $menu }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table id="example1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Sampah</th>
                                            <th>Berat</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($penjualan as $jual)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $jual->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $jual->sampah->jenis }}</td>
                                                <td>{{ $jual->berat }} Kg</td>
                                                <td>Rp {{ $jual->nilai }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
