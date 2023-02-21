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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="{{ route('user.create') }}" id="" class="btn btn-info btn-xs float-right">
                                <i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->nohp }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td><img src="{{ url('storage/photo', $user->photo) }}" width="50px"
                                                    class="img-fluid" alt=""></td>
                                            <td>
                                                <div class="text-center">
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit" title="Edit Data"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-primary btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#modal-password{{ $user->id }}">
                                                            <i class="fa fa-key" title="Password"></i>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger btn-xs">
                                                            <i class="fa fa-trash" title="Hapus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-password{{ $user->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('user.password', $user->id) }}" method="POST">
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
                                                                <input value="{{ $user->username }}" class="form-control"
                                                                    disabled>
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
@endsection


@section('script')
    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif

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
