@extends('layouts.app')

@section('content')
    @include('layouts.menu-mobile')
    <div class="content-header"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row-flex">
                <div class="col-lg-10 col-md-12">
                    <div class="invoice p-3 mb-3">
                        <div class="card-header ">
                            <h3 class="card-header-title text-center">{{ $menu }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive table-striped">
                                <table id="example1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="3%">No</th>
                                            <th width="15%">Tanggal Penarikan</th>
                                            <th width="20%">Jumlah penarikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($penarikan as $p)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                                <td>Rp {{ $p->nilai }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="2"></th>
                                            <th class="text-primary">Saldo Akhir : Rp {{ $saldo->saldo }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
