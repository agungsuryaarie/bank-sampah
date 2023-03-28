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
                        <div class="card-header">
                            <a href="javascript:void(0)" id="" class="btn btn-info btn-xs float-right"
                                data-toggle="modal" data-target="#tambahsaldo">
                                <i class="fas fa-credit-card"></i> Tarik Saldo</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
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
                                            <td>{{ $t->nilai }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @if ($t->status == 1)
                                                        <form action="{{ route('nasabah.penarikan.destroy', $t->id) }}"
                                                            method="POST">
                                                            <button class="btn btn-warning btn-xs"> Menunggu </button>
                                                            <button type="button" class="btn btn-success btn-xs"
                                                                data-toggle="modal" data-target="#edit{{ $t->id }}">
                                                                <i class="fa fa-edit" title="Edit Data"></i>
                                                            </button>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash" title="Hapus"></i>
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
                                        <div class="modal fade" id="edit{{ $t->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Penarikan Saldo</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('nasabah.penarikan.update', $t->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Saldo Tersedia<span class="text-danger">
                                                                                *</span></label>
                                                                        <input type="text" value="Rp {{ $saldo }}"
                                                                            class="form-control" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Jumlah Penarikan<span class="text-danger">
                                                                                *</span></label>
                                                                        <input type="text" name="nilai"
                                                                            value="{{ $t->nilai }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.card -->
                                                        </div>
                                                        <div class="modal-footer justify-content-flex-end">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

    {{-- Modat Tambah saldo --}}
    <div class="modal fade" id="tambahsaldo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tarik Saldo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('nasabah.penarikan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Saldo Tersedia<span class="text-danger"> *</span></label>
                                    <input type="text" value="Rp {{ $saldo }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Penarikan<span class="text-danger"> *</span></label>
                                    <input type="text" name="nilai" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-flex-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
