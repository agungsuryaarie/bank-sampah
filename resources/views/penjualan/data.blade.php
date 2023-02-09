@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0)" id="" class="btn btn-info btn-xs float-right"
                                data-toggle="modal" data-target="#tambah">
                                <i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pengepul</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet</td>
                                        <td>Win 95+</td>
                                        <td>Win 95+</td>
                                        <td>Win 95+</td>
                                        <td> 4</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="#" class="btn btn-primary btn-xs" data-toggle="modal"
                                                    data-target="#detailcatatan"><i class="fa fa-eye"
                                                        title="Lihat"></i></a>
                                                <a href="#" class="btn btn-success btn-xs" data-toggle="modal"
                                                    data-target="#edit"><i class="fa fa-edit" title="Edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                        title="Hapus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modat Tambah --}}
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Penjualan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Sampah<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Jenis Sampah">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pengepul<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Nama Pengepul">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id="" placeholder="Alamat">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id="" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id="" placeholder="Berat">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id="" placeholder="Total">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="modal-footer justify-content-flex-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modat Edit --}}
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Penjualan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Sampah<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Jenis Sampah">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pengepul<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Nama Pengepul">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Alamat">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Berat">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" id=""
                                                placeholder="Total">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="modal-footer justify-content-flex-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail Catatan --}}
    <div class="modal fade" id="detailcatatan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">detail catatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Tanggal</th>
                                    <td>:</td>
                                    <td>09-Januari-2023</td>
                                </tr>
                                <tr>
                                    <th>Nama Pengepul</th>
                                    <td>:</td>
                                    <td>Fahmi</td>
                                </tr>

                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>:</td>
                                    <td>081213359183</td>
                                </tr>
                                <tr>
                                    <th>Jenis Sampah</th>
                                    <td>:</td>
                                    <td>Kertas</td>
                                </tr>
                                <tr>
                                    <th>Harga Satuan</th>
                                    <td>:</td>
                                    <td>9000</td>
                                </tr>
                                <tr>
                                    <th>Berat</th>
                                    <td>:</td>
                                    <td>12kg</td>
                                </tr>
                                <tr>
                                    <th>Total harga</th>
                                    <td>:</td>
                                    <td>19000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-flex-end">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
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
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
<!-- /.card -->
