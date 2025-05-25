 <!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Admin</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <style>
            /* Mengubah warna tombol menjadi kuning */
            .btn-custom {
                background-color: #D4AF37 !important;
                border-color: #D4AF37 !important;
                color: white !important;
            }
            
            .btn-custom:hover {
                background-color: #C9A030 !important; /* Sedikit lebih gelap saat hover */
                border-color: #C9A030 !important;
            }
            
            .btn-custom:focus, 
            .btn-custom:active {
                background-color: #B8912A !important;
                border-color: #B8912A !important;
                box-shadow: 0 0 5px #D4AF37 !important;
            }

            .form-control:focus {
                border-color: #D4AF37 !important;
                box-shadow: 0 0 5px #D4AF37 !important;
            }
            
        </style>
    </head>
    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card shadow-sm p-4 border-0" style="width: 100%; max-width: 400px;">
            <h4 class="text-center mb-4">Admin Login</h4>
            <form action="{{ route('admin.authenticate') }}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="text" value="{{ old('email') }}" class="form-control border-0 border-bottom @error('email') is-invalid @enderror" name="email" id="email" placeholder="Username">
                    @error('email')<p class="text-danger small">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control border-0 border-bottom @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                    @error('password')<p class="text-danger small">{{ $message }}</p>@enderror
                </div>
                <button class="btn btn-custom w-100 py-2 rounded-pill shadow-sm" type="submit">LOGIN</button>
            </form>
        </div>
    </body>
</html>
