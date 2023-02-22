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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary card-outline">
                        <!-- form start -->
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Username">
                                            @error('username')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter email">
                                            @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="nohp" value="{{ old('nohp') }}"
                                                class="form-control @error('nohp') is-invalid @enderror"
                                                placeholder="Phone">
                                            @error('nohp')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control @error('type') is-invalid @enderror select2bs4"
                                                name="type" style="width: 100%;">
                                                <option>Pilih</option>
                                                <option value="1" @selected(old('type') == '1')>Admin</option>
                                                <option value="2" @selected(old('type') == '2')>Bendahara</option>
                                                <option value="3" @selected(old('type') == '3')>Pengurus</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input type="file" name="photo" id="image"
                                                class="form-control @error('photo') is-invalid @enderror"
                                                placeholder="Foto">
                                            @error('photo')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="form-group">
                                            <label>Preview</label><br>
                                            <img id="preview-image-before-upload" src="{{ url('img/81913-200.png') }}"
                                                alt="preview image" style="max-height: 250px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('user.index') }}" class="btn btn-danger btn-sm">Batal</a>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
