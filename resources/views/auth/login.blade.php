<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ url('login/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ url('login/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('login/css/theme-default.css') }}" class="template-customizer-theme-css" />

    <script src="{{ url('login/js/helpers.js') }}"></script>

    <link rel="stylesheet" href="{{ url('login/css/style.css') }}" />
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(login/img/bg-sampah.jpg)"></div>
                        <div class="login-wrap p-6">
                            <div class="d-flex">
                                <div class="w-100">
                                    <img src="login/img/logobb.png" class="mb-3" style="width: 100px" />
                                    <h6 class="mb-4">
                                        Login Ke Aplikasi Bank Sampah
                                    </h6>
                                </div>
                            </div>
                            @if (Session::has('error'))
                                <div id="alert" class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
                            <form action="{{ route('masuk') }}" class="mb-3" action="" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"required
                                            autocomplete="email" placeholder="Enter your email" autofocus />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="bx bx-envelope"></i></span>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember-me"{{ old('remember') ? 'checked' : '' }} />
                                        <div class="d-flex justify-content-between">
                                            <label class="form-check-label" for="remember-me">
                                                {{ __('Ingat saya') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary float-right" type="submit">
                                        Sign in
                                    </button>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('register') }}">
                                        <small>Klik Daftar untuk Nasabah baru</small>
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ url('login/js/jquery.min.js') }}"></script>
    <script src="{{ url('login/js/popper.js') }}"></script>
    <script src="{{ url('login/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('login/js/main.js') }}"></script>
</body>

</html>
