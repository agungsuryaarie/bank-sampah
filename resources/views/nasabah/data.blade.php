@extends('layouts.app')

@section('content')
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
                            @if (Auth::user()->type == 'admin')
                                <a href="{{ route('nasabah.create') }}" id=""
                                    class="btn btn-info btn-xs float-right">
                                    <i class="fas fa-plus-circle"></i> Tambah</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Phone</th>
                                        <th>Saldo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->alamat }}</td>
                                            <td>{{ $customer->nohp }}</td>
                                            <td>{{ $customer->saldo->saldo }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @if (Auth::user()->type != 'admin')
                                                        <a href="javascript:void(0)" data-toggle="tooltip"
                                                            data-id="{{ $customer->id }}" data-original-title="Show"
                                                            class="btn btn-warning btn-xs show">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <form action="{{ route('nasabah.destroy', $customer->id) }}"
                                                            method="POST">
                                                            <a href="javascript:void(0)" data-toggle="tooltip"
                                                                data-id="{{ $customer->id }}" data-original-title="Show"
                                                                class="btn btn-warning btn-xs show">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('nasabah.edit', $customer->id) }}"
                                                                class="btn btn-success btn-xs">
                                                                <i class="fa fa-edit" title="Edit Data"></i>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-primary btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#modal-password{{ $customer->id }}">
                                                                <i class="fa fa-key" title="Password"></i>
                                                            </button>
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash" title="Hapus"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-password{{ $customer->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('nasabah.password', $customer->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah Password</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input value="{{ $customer->username }}"
                                                                    class="form-control" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Chage Password</label>
                                                                <input type="password" name="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success btn-xs">Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="ajaxModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Nasabah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="name" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" id="username" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" id="nohp" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea id="alamat" class="form-control" rows="3" disabled></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4">
                                <div class="form-group text-center">
                                    <label>Preview</label><br>
                                    <img id="gambar" src="{{ url('img/81913-200.png') }}" alt="preview image"
                                        style="max-height: 250px;">
                                </div>
                            </div>
                        </div>
                    </div>
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

        $("body").on("click", ".show", function() {
            var nasabah_id = $(this).data("id");
            $.get("{{ route(Auth::user()->type . '.nasabah.index') }}" + "/show/" + nasabah_id, function(
                data) {
                $("#ajaxModel").modal("show");
                $("#name").val(data.name);
                $("#username").val(data.username);
                $("#email").val(data.email);
                $("#nohp").val(data.nohp);
                $("#alamat").val(data.alamat);
                $('#gambar').attr('src', "{{ url('storage/photo') }}" + "/" + data.photo);
                $("#saldo").val(data.debit);
            });
        });
    </script>
@endsection
