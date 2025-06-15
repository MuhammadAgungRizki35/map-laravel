<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Map Printing</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/glass.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

        <style>
            body {
                background-color: #f8f9fa;
            }
            .card {
                /* --bs-card-bg: rgb(255 255 255 / 15%); */
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }

            h1, h2, h3, h4, h5, h6 {
    font-family: 'Montserrat', sans-serif;
}


            .form-control {
                border: none;
                background: #f8f9fa;
                border-radius: 0;
                padding-left: 5px;
                /* background-color: transparent; */
                box-shadow: none;
            }
            .form-control:focus {
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
                box-shadow: none;
                outline: none;
            }
            .btn-primary {
                background: rgb(47 0 224 / 64%);
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
                border-radius: 25px;
            }
            .btn-primary:hover {
                background: #667ce8;
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            }
            h4 {
                font-weight: bold;
                text-align: center;

            }
            .form-floating > label {
                left: 5px;
                font-size: 0.9rem;
                color: #6c757d;
            }
            .tittle {
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            }
        </style>
    </head>
    <body id="mainBody" class="bg-light">
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                                        @endif
                                        @if(Session::has('error'))
                                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                        @endif
                                     <div class="mb-4 text-center">
    <h1 style="font-family: 'Montserrat', sans-serif;">Map Printing</h1>
</div>


                                    </div>
                                </div>
                                <form action="{{ route('account.authenticate') }}" method="post">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
                                                <label for="email">Alamat Email</label>
                                                @error('email')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                                <label for="password">Kata Sandi</label>
                                                @error('password')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary py-3" type="submit">MASUK</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-4 mb-3 border-secondary-subtle">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('account.register') }}" class="text-decoration-none" style="color: #primary;">Buat akun baru</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        @vite(['resources/js/app.js', 'resources/css/glass.css'])
    </body>
</html>
