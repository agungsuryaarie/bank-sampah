<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="{{ url('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('dist/css/adminlte.min.css') }}" rel="stylesheet">
    {{-- @vite('resources/js/app.js') --}}
</head>

<body class="hold-transition login-page">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="col-md-10">
                <div class="card card-success card-outline">
                    <div class="card-header text-center">
                        <a href="{{ route('login') }}" class="h1">
                            <img src="{{ url('img/logo_bs.png') }}" alt="Logo" class="brand-image"
                                style="opacity: .8" width="45px">
                            <b>Bank</b>Sampah
                        </a>
                        <p class="login-box-msg">Daftar ke Aplikasi Bank Sampah</p>
                    </div>
                    <form action="{{ route('customer.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" placeholder="Nama Lengkap">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" placeholder="Username">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="input-group mb-3">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="Email">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('nohp') is-invalid @enderror"
                                            name="nohp" value="{{ old('nohp') }}" placeholder="No HP">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                        @error('nohp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            value="{{ old('password') }}" placeholder="Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-key"></span>
                                            </div>
                                        </div>
                                        @error('nohp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="file" id="image"
                                            class="form-control @error('photo') is-invalid @enderror" name="photo"
                                            value="{{ old('photo') }}" placeholder="Photo Profil" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-image"></span>
                                            </div>
                                        </div>
                                        @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="form-group">
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                            placeholder="Alamat">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="form-group">
                                        <img id="preview-image-before-upload" src="{{ url('img/81913-200.png') }}"
                                            alt="preview image" style="max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('login') }}" class="text-center">Sudah punya akun? Silahkan Login</a>
                            <button type="submit" class="btn btn-success btn-sm float-right"><i
                                    class="fas fa-paper-plane"></i> Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
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
</body>

</html>
