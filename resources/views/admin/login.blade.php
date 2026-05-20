<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Avenoir Kitchen</title>
    <!-- Template CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
</head>
<body class="sub_page">
    <div class="hero_area vh-100 d-flex align-items-center">
        <div class="container" style="margin-top: 80px;">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5">
                    <div class="card border-0 shadow-lg rounded">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/logo/logoavenoir-removebg-preview.png') }}" alt="logo avenoir" style="width: 80px;">
                            </div>
                            <h2 class="text-center mb-4 font-weight-bold text-dark">Login Account</h2>

                            @if (session('error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="username" class="font-weight-bold">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="font-weight-bold">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 text-uppercase font-weight-bold">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Scripts -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</body>
</html>