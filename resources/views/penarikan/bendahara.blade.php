@extends('layouts.app')

@section('content')
    @include('layouts.menu-mobile')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $menu }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $menu }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nasabah</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Jumlah Penarikan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($penarikan as $t)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $t->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $t->nasabah->name }}</td>
                                            <td>{{ $t->nasabah->email }}</td>
                                            <td>{{ $t->nasabah->alamat }}</td>
                                            <td>Rp {{ $t->nilai }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @if ($t->status == 1)
                                                        <form action="{{ route('bendahara.penarikan.update', $t->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2"
                                                                class="form-control">
                                                            <button type="submit" class="btn btn-success btn-xs">
                                                                Terima
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('bendahara.penarikan.update', $t->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="3"
                                                                class="form-control">
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    @elseif ($t->status == 2)
                                                        <button class="btn btn-success btn-xs"> Diterima </button>
                                                    @else
                                                        <button class="btn btn-danger btn-xs"> Ditolak </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
<!-- /.card -->
