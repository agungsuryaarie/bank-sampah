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
                            @if (Auth::user()->type == 'admin' || Auth::user()->type == 'pengurus')
                                <a href="javascript:void(0)" id="tambah" class="btn btn-info btn-xs float-right">
                                    <i class="fas fa-plus-circle"></i> Tambah
                                </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nasabah</th>
                                        <th>Pengepul</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat</th>
                                        <th>Total</th>
                                        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'pengurus')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (Auth::user()->type == 'admin' || Auth::user()->type == 'pengurus')
        {{-- Modal Tambah --}}
        <div class="modal fade" id="ajaxModel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="transaksiForm" name="transaksiForm" class="form-horizontal">
                            @csrf
                            <div class="card">
                                <input type="hidden" name="transaksi_id" id="transaksi_id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nasabah</label>
                                                <select
                                                    class="form-control select2  @error('nasabah_id') is-invalid @enderror"
                                                    name="nasabah_id" id="nasabah_id" style="width: 100%;">
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
                                                    name="sampah_id" id="sampah_id" style="width: 100%;">
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
                                                    placeholder="Berat">
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
                                                <input type="text" name="nilai" id="nilai"
                                                    value="{{ old('nilai') }}"
                                                    class="form-control @error('nilai') is-invalid @enderror"
                                                    placeholder="nilai">
                                                @error('nilai')
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="saveBtn"
                                        value="create">Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            @if (Auth::user()->type == 'admin' || Auth::user()->type == 'pengurus')
                var table = $("#data-table").DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    dom: 'Bfrtip',
                    buttons: ["excel", "pdf", "print", "colvis"],
                    ajax: "{{ route(Auth::user()->type . '.transaksi.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'nasabah',
                            name: 'nasabah'
                        },
                        {
                            data: 'petugas',
                            name: 'petugas'
                        },
                        {
                            data: 'sampah',
                            name: 'sampah'
                        },
                        {
                            data: 'berat',
                            name: 'berat'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                })

                $("#tambah").click(function() {
                    $("#saveBtn").val("create-transaksi");
                    $("#transaksi_id").val("");
                    $("#transaksiForm").trigger("reset");
                    $("#modelHeading").html("Tambah Transaksi");
                    $("#ajaxModel").modal("show");
                });

                $("body").on("click", ".edit", function() {
                    var transaksi_id = $(this).data("id");
                    $.get("{{ route(Auth::user()->type . '.transaksi.index') }}" + "/" + transaksi_id +
                        "/edit",
                        function(data) {
                            $("#ajaxModel").modal("show");
                            $("#modelHeading").html("Edit Transaksi");
                            $("#nasabah_id").val(data.nasabah_id);
                            $("#sampah_id").val(data.sampah_id);
                            $("#berat").val(data.berat);
                            $("#nilai").val(data.nilai);
                            $("#transaksi_id").val(data.id);
                        });
                });

                $(document).on('change', '#sampah_id', function() {
                    var sampah_id = $(this).val();
                    $.get("{{ route(Auth::user()->type . '.transaksi.index') }}" + "/" + sampah_id +
                        "/sampah",
                        function(data) {
                            $("#harga").html("Per 1 Kg = Rp. " + data.harga_nasabah);
                            $('#preview').attr('src', "{{ url('storage/sampah') }}" + "/" + data
                                .gambar);
                            $("#berat").removeAttr("disabled");
                        });
                });

                $("#berat").keyup(function() {
                    var berat = this.value;
                    var sampah_id = $("#sampah_id").val();
                    $.get("{{ route(Auth::user()->type . '.transaksi.index') }}" + "/" + sampah_id +
                        "/sampah",
                        function(data) {
                            var nilai = parseFloat(berat) * parseFloat(data.harga_nasabah);
                            $("#nilai").val(nilai);
                        });
                });

                $("#saveBtn").click(function(e) {
                    e.preventDefault();
                    $(this).html(
                        "<span class='spinner-border spinner-border-sm'></span><span class='visually-hidden'><i> menyimpan...</i></span>"
                    );
                    var transaksi_id = $("#transaksi_id").val();
                    if (transaksi_id == '') {
                        $.ajax({
                            data: $("#transaksiForm").serialize(),
                            url: "{{ route(Auth::user()->type . '.transaksi.store') }}",
                            type: "POST",
                            dataType: "json",
                            success: function(data) {
                                if (data.errors) {
                                    $('.alert-danger').html('');
                                    $.each(data.errors, function(key, value) {
                                        $('.alert-danger').show();
                                        $('.alert-danger').append('<strong><li>' +
                                            value +
                                            '</li></strong>');
                                        $(".alert-danger").fadeOut(5000);
                                        $("#saveBtn").html("Simpan");
                                    });
                                } else {
                                    table.draw();
                                    $('#transaksiForm').trigger("reset");
                                    $("#saveBtn").html("Simpan");
                                    $('#ajaxModel').modal('hide');
                                    alertSuccess(data.success);
                                }
                            },
                        });
                    } else {
                        var transaksi_id = $("#transaksi_id").val();
                        $.ajax({
                            data: $("#transaksiForm").serialize(),
                            url: "{{ route(Auth::user()->type . '.transaksi.index') }}" + "/" +
                                transaksi_id + "/update",
                            type: "POST",
                            dataType: "json",
                            success: function(data) {
                                if (data.errors) {
                                    $('.alert-danger').html('');
                                    $.each(data.errors, function(key, value) {
                                        $('.alert-danger').show();
                                        $('.alert-danger').append('<strong><li>' +
                                            value +
                                            '</li></strong>');
                                        $(".alert-danger").fadeOut(5000);
                                        $("#saveBtn").html("Simpan");
                                    });
                                } else {
                                    table.draw();
                                    $('#transaksiForm').trigger("reset");
                                    $("#saveBtn").html("Simpan");
                                    $('#ajaxModel').modal('hide');
                                    alertSuccess(data.success);
                                }
                            },
                        });
                    }
                });


                $("body").on("click", ".delete", function() {
                    var transaksi_id = $(this).data("id");
                    confirm("Are You sure want to delete !");
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route(Auth::user()->type . '.transaksi.index') }}" + "/" +
                            transaksi_id + "/destroy",
                        data: {
                            _token: "{!! csrf_token() !!}",
                        },
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log("Error:", data);
                        },
                    });
                });
            @else
                var table = $("#data-table").DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    dom: 'Bfrtip',
                    buttons: ["excel", "pdf", "print", "colvis"],
                    ajax: "{{ route(Auth::user()->type . '.transaksi.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'nasabah',
                            name: 'nasabah'
                        },
                        {
                            data: 'petugas',
                            name: 'petugas'
                        },
                        {
                            data: 'sampah',
                            name: 'sampah'
                        },
                        {
                            data: 'berat',
                            name: 'berat'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                    ]
                })
            @endif
        });
    </script>
@endsection
<!-- /.card -->
