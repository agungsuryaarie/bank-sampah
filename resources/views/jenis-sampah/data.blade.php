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
                            @if (Auth::user()->type == 'admin')
                                <a href="javascript:void(0)" id="" class="btn btn-info btn-xs float-right"
                                    data-toggle="modal" data-target="#tambah">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Sampah</th>
                                        <th>Harga Nasabah</th>
                                        <th>Harga Pengepul</th>
                                        <th>Gambar</th>
                                        @if (Auth::user()->type == 'admin')
                                            <th>Action</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($sampah as $samp)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $samp->jenis }}</td>
                                            <td>{{ $samp->harga_nasabah }}</td>
                                            <td>{{ $samp->harga_pengepul }}</td>
                                            <td><img src="{{ url('storage/sampah', $samp->gambar) }}" width="50px"
                                                    class="img-fluid" alt="">
                                            </td>
                                            @if (Auth::user()->type == 'admin')
                                                <td>
                                                    <div class="text-center">
                                                        <form action="{{ route('sampah.destroy', $samp->id) }}"
                                                            method="POST">
                                                            <a href="javascript:void(0)" class="btn btn-success btn-xs"
                                                                data-toggle="modal" data-target="#edit{{ $samp->id }}">
                                                                <i class="fa fa-edit" title="Edit Data"></i>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash" title="Hapus"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        {{-- Modat Edit --}}
                                        <div class="modal fade" id="edit{{ $samp->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Jenis Sampah</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('sampah.update', $samp->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            <div class="card">
                                                                @csrf
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 md-4">
                                                                            <div class="form-group">
                                                                                <label>Jenis Sampah<span
                                                                                        class="text-danger">
                                                                                        *</span></label>
                                                                                <input type="text" name="jenis"
                                                                                    value="{{ $samp->jenis }}"
                                                                                    class="form-control @error('jenis') is-invalid @enderror"
                                                                                    placeholder="Jenis Sampah">
                                                                                @error('jenis')
                                                                                    <span class="invalid-feedback">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 md-4">
                                                                            <div class="form-group">
                                                                                <label>Harga Nasabah<span
                                                                                        class="text-danger">
                                                                                        *</span></label>
                                                                                <input type="text" name="harga_nasabah"
                                                                                    value="{{ $samp->harga_nasabah }}"
                                                                                    class="form-control @error('harga_nasabah') is-invalid  @enderror"
                                                                                    placeholder="Harga Nasabah">
                                                                                @error('harga_nasabah')
                                                                                    <span class="invalid-feedback">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 md-4">
                                                                            <div class="form-group">
                                                                                <label>Harga Pengepul<span
                                                                                        class="text-danger">
                                                                                        *</span></label>
                                                                                <input type="text" name="harga_pengepul"
                                                                                    value="{{ $samp->harga_pengepul }}"
                                                                                    class="form-control @error('harga_pengepul') is-invalid  @enderror"
                                                                                    placeholder="Harga Pengepul">
                                                                                @error('harga_pengepul')
                                                                                    <span class="invalid-feedback">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 md-4">
                                                                            <div class="form-group">
                                                                                <label>Berat<span class="text-danger">
                                                                                        *</span></label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" name="berat"
                                                                                        value="{{ $samp->berat }}"
                                                                                        class="form-control @error('berat') is-invalid  @enderror">
                                                                                    <div class="input-group-append">
                                                                                        <span
                                                                                            class="input-group-text">KG</span>
                                                                                    </div>
                                                                                    @error('berat')
                                                                                        <span class="invalid-feedback">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 md-4">
                                                                            <div class="form-group">
                                                                                <label>Gambar<span class="text-danger">
                                                                                        *</span></label>
                                                                                <div class="input-group">
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                            name="gambar"
                                                                                            class="custom-file-input"
                                                                                            id="image">
                                                                                        <label
                                                                                            class="custom-file-label">Choose
                                                                                            file
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 md-4">
                                                                            <div class="form-group">
                                                                                <label>Preview</label><br>
                                                                                <img id="preview-image-before-upload"
                                                                                    src="{{ url('storage/sampah', $samp->gambar) }}"
                                                                                    alt="preview image"
                                                                                    style="max-height: 150px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-flex-end">
                                                                <button type="button" class="btn btn-default btn-xs"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-xs">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jenis Sampah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sampah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">                         
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 md-4">
                                        <div class="form-group">
                                            <label>Jenis Sampah<span class="text-danger"> *</span></label>
                                            <input type="text" name="jenis" value="{{ old('jenis') }}"
                                                class="form-control @error('jenis') is-invalid @enderror"
                                                placeholder="Jenis Sampah">
                                            @error('jenis')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 md-4">
                                        <div class="form-group">
                                            <label>Harga Nasabah<span class="text-danger"> *</span></label>
                                            <input type="text" name="harga_nasabah"
                                                value="{{ old('harga_nasabah') }}"
                                                class="form-control @error('harga_nasabah') is-invalid  @enderror"
                                                placeholder="Harga Nasabah">
                                            @error('harga_nasabah')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 md-4">
                                        <div class="form-group">
                                            <label>Harga Pengepul<span class="text-danger"> *</span></label>
                                            <input type="text" name="harga_pengepul"
                                                value="{{ old('harga_pengepul') }}"
                                                class="form-control @error('harga_pengepul') is-invalid  @enderror"
                                                placeholder="Harga Pengepul">
                                            @error('harga_pengepul')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 md-4">
                                        <div class="form-group">
                                            <label>Berat<span class="text-danger"> *</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="berat" value="{{ old('berat') }}"
                                                    class="form-control @error('berat') is-invalid  @enderror">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">KG</span>
                                                </div>
                                                @error('berat')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 md-4">
                                        <div class="form-group">
                                            <label>Gambar<span class="text-danger"> *</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="gambar" class="custom-file-input"
                                                        id="image">
                                                    <label class="custom-file-label">Choose file
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 md-4">
                                        <div class="form-group">
                                            <label>Preview</label><br>
                                            <img id="preview-image-before-upload" src="{{ url('img/sampah.png') }}"
                                                alt="preview image" style="max-height: 250px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-flex-end">
                            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

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
