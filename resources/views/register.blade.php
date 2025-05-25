<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/glass.css') }}">
        <style>
            body {
                background-color: #f8f9fa;
            }
            .card {
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }
            .form-control {
                border: none;
                border-bottom: 2px solid #D4AF37;
                border-radius: 0;
                padding-left: 5px;
                background-color: transparent;
                box-shadow: none;
            }
            .form-control:focus {
                border-bottom: 2px solid #C9A02D;
                box-shadow: none;
                outline: none;
            }
            .btn-primary {
                background-color: #D4AF37;
                border-color: #D4AF37;
                font-weight: bold;
                border-radius: 25px;
            }
            .btn-primary:hover {
                background-color: #C9A02D;
                border-color: #C9A02D;
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
        </style>
    </head>
    <body id="mainBody">
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <h4>Register Here</h4>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('account.processregister') }}" method="post">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name">
                                                <label for="name">Name</label>
                                                @error('name')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
                                                <label for="email">Email</label>
                                                @error('email')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                                <label for="password">Password</label>
                                                @error('password')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                                <label for="password_confirmation">Confirm Password</label>
                                                @error('password_confirmation')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary py-3" type="submit">Register Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-4 mb-3 border-secondary-subtle">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('account.login') }}" class="text-decoration-none" style="color: #D4AF37;">Click here to login</a>
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
