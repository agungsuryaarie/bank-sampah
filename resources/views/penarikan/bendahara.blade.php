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
                                                        <button type="button" class="btn btn-success btn-xs"
                                                            data-toggle="modal" data-target="#modal-terima">
                                                            Terima
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                            data-toggle="modal" data-target="#modal-tolak">
                                                            Tolak
                                                        </button>
                                                        <div class="modal fade" id="modal-terima">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form
                                                                        action="{{ route('bendahara.penarikan.update', $t->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Konfirmasi</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="status"
                                                                                value="2" class="form-control">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">Tanggal</span>
                                                                                </div>
                                                                                <input type="date" name="tanggal"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <p class="text-center">Apakah kamu yakin
                                                                                menerima transaksi ini? &hellip;</p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                class="btn btn-default btn-xs"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-xs">Terima</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="modal-tolak">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form
                                                                        action="{{ route('bendahara.penarikan.update', $t->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Konfirmasi</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="status"
                                                                                value="3" class="form-control">
                                                                            <p class="text-center">Apakah kamu yakin menolak
                                                                                transaksi ini? &hellip;</p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                class="btn btn-default btn-xs"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger btn-xs">Tolak</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                    @elseif ($t->status == 2)
                                                        <button class="btn btn-success btn-xs"> Diterima </button>
                                                        <button type="button" class="btn btn-warning btn-xs"
                                                            data-toggle="modal" data-target="#modal-tanggal">
                                                            Update
                                                        </button>
                                                        <div class="modal fade" id="modal-tanggal">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form
                                                                        action="{{ route('bendahara.penarikan.tanggal', $t->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Konfirmasi</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="status"
                                                                                value="2" class="form-control">
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">Tanggal</span>
                                                                                </div>
                                                                                <input type="date" name="tanggal"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <p class="text-center">Apakah kamu yakin
                                                                                mengubah transaksi ini? &hellip;</p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                class="btn btn-default btn-xs"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-xs">Terima</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
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
