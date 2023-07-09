<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ url('login/css/custom.css') }}" />
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <section class="testimonial py-5" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-4 py-3 bg-success text-white text-center border-radius-img ">
                    <div class=" ">
                        <div class="card-body">
                            <img src="{{ url('img/img-bs.png') }}" style="width:100%">
                            <h5 class="py-3">Daftar Ke Aplikasi Bank Sampah</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-5 border border-radius">
                    <form action="{{ route('customer.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" placeholder="Nama Lengkap"
                                    class="form-control @error('name') is-invalid @enderror">
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group col-md-6">
                                <input type="text" placeholder="Username"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}">
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group col-md-6">
                                <input type="text"class="form-control @error('nohp') is-invalid @enderror"
                                    name="nohp"value="{{ old('nohp') }}" placeholder="No HP">
                            </div>
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" placeholder="Password">
                            </div>
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="form-group col-md-6">
                                <input type="file"
                                    id="image"class="form-control @error('photo') is-invalid @enderror"
                                    name="photo" value="{{ old('photo') }}"placeholder="Photo Profil" required>
                            </div>
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group col-md-6">
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Alamat">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-4 mb-3">
                                <div class="form-group">
                                    <img id="preview-image-before-upload" src="{{ url('img/example.png') }}"
                                        alt="preview image" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('login') }}" class="text-center">Sudah punya akun?
                                Silahkan Login</a>
                            <button type="submit" class="btn btn-success btn-sm float-right"><i
                                    class="fas fa-paper-plane"></i> Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
