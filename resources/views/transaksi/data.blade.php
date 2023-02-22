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
                                        <th>Nasabah</th>
                                        <th>Pengepul</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($transaksi as $trans)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $trans->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $trans->nasabah->name }}</td>
                                            <td>{{ $trans->user->name }}</td>
                                            <td>{{ $trans->sampah->jenis }}</td>
                                            <td>{{ $trans->berat }} Kg</td>
                                            <td>{{ $trans->total }}</td>
                                            <td>
                                                <div class="text-center">
                                                    <form action="{{ route('transaksi.destroy', $trans->id) }}"
                                                        method="POST">
                                                        <a href="javascript:void(0)" class="btn btn-success btn-xs"
                                                            data-toggle="modal" data-target="#edit{{ $trans->id }}">
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

    {{-- Modal Tambah --}}
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
                    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nasabah</label>
                                            <select class="form-control select2  @error('nasabah_id') is-invalid @enderror"
                                                name="nasabah_id" style="width: 100%;">
                                                <option>Pilih</option>
                                                @foreach ($user as $nasabah)
                                                    <option value="{{ $nasabah->id }}" @selected(old('nasabah_id') == $nasabah->id)>
                                                        {{ $nasabah->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('nasabah_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Sampah</label>
                                            <select class="form-control @error('sampah_id') is-invalid @enderror"
                                                name="sampah_id" id="sampah" style="width: 100%;">
                                                <option>Pilih</option>
                                                @foreach ($sampah as $sam)
                                                    <option value="{{ $sam->id }}" @selected(old('sampah_id') == $sam->id)>
                                                        {{ $sam->jenis }}</option>
                                                @endforeach
                                            </select>
                                            @error('sampah_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat<span class="text-danger"> * </span> <small>Silahkan pilih jenis
                                                    sampah</small></label>
                                            <input type="text" name="berat" id="berat"
                                                class="form-control @error('berat') is-invalid @enderror"
                                                placeholder="Berat" value="{{ old('berat') }}" disabled>
                                            @error('berat')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total<span class="text-danger"> *</span></label>
                                            <input type="text" name="total" id="total" value="{{ old('total') }}"
                                                class="form-control @error('total') is-invalid @enderror"
                                                placeholder="Total">
                                            @error('total')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <label>Harga Sampah <span id="harga"></span></label><br>
                                            <img id="preview" src="{{ url('img/sampah.png') }}" alt="preview image"
                                                style="max-height: 150px;"><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-flex-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
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
        $(document).on('change', '#sampah', function() {
            var sampah_id = $(this).val();
            $.get("{{ route('transaksi.index') }}" + "/" + sampah_id + "/sampah", function(data) {
                $("#harga").html("Per 1 Kg = Rp. " + data.harga_nasabah);
                $('#preview').attr('src', "{{ url('storage/sampah') }}" + "/" + data.gambar);
                $("#berat").removeAttr("disabled");
            });
        });

        $("#berat").keyup(function() {
            var berat = this.value;
            var sampah_id = $("#sampah").val();
            $.get("{{ route('transaksi.index') }}" + "/" + sampah_id + "/sampah", function(data) {
                var total = parseFloat(berat) * parseFloat(data.harga_nasabah);
                $("#total").val(total);
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
