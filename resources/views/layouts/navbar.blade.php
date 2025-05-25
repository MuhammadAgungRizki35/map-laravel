<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User {{ Auth::user()->name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/glass.css') }}">
   <style>
    /* Body background gradient */
    body {
        background: linear-gradient(to right, #4a00e0, #8e2de2);
        min-height: 100vh;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar with Glassmorphism */
    #sidebar {
        background: rgba(74, 0, 224, 0.2); /* ungu transparan */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        /* border-radius: 16px; */
        box-shadow: 0 8px 32px rgba(232, 8, 8, 0.37);
        color: rgb(4, 238, 255);
    }

    /* Navbar with Glassmorphism */
    .navbar {
      background: linear-gradient(to right, #4a00e0, #8e2de2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 0 0 16px 16px;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        color: white;
    }

    /* Nav links in sidebar */
    .nav-pills .nav-link {
        background-color: transparent !important;
        color: rgb(0, 0, 0) !important;
        border-radius: 5px;
    }

    .nav-pills .nav-link:hover,
    .nav-pills .nav-link.active {
        background-color: #4a00e0 !important;
        color: #ffffff !important;
    }

    /* Primary button */
    .btn-primary {
        background-color: #4a00e0 !important;
        border-color: #ffffff !important;
        color: rgb(255, 255, 255) !important;
    }

    .btn-primary:hover {
        background-color: #ffffff !important;
        border-color: #4a00e0 !important;
        color: #000000 !important;
    }

    /* General link styles */
    .nav-link, .navbar a, .navbar button, .navbar-brand, .dropdown-item {
        color: white !important;
    }

    .nav-link:hover,
    .dropdown-item:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Dropdown menu glassmorphism */
    .dropdown-menu {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 10px;
    }

    .dropdown-item {
        color: white;
    }

    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.25);
    }

    /* Optional spacing/padding tweaks */
    #sidebar h4 {
        color: #000000;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .navbar-brand {
        font-weight: bold;
    }
</style>

</head>
<body id="mainBody">
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 bg-light vh-100 p-3 d-none" style="width: 250px;">
            <h4 class="text-center">MENU</h4>
            <ul class="nav nav-pills flex-column mb-auto" id="SidebarMenu">
                <li class="nav-item">
                    <a href="{{ route('account.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.memesan.index') }}" class="nav-link">Pesan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.logout') }}" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-md btn-info shadow-sm px-4">
                <div class="container-fluid">
                    <button id="toggleSidebar" class="btn btn-primary me-3">☰</button>
                    <a class="navbar-brand" href="#"><strong>DASHBOARD</strong></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        {{-- <button onclick="toggleTheme()" class="btn btn-sm btn-light">🌓 Toggle Mode</button> --}}
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" data-bs-toggle="dropdown">
                                    {{-- <img src="{{ asset('storage/img/user.svg') }}" alt="User Profile" class="rounded-circle" width="29"> --}}
                                    <i class="bi bi-person" style="font-size: 35px; color: #ffffff;"> {{ Auth::user()->name }}</i>
                                </a>


                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('account.logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid mt-4 ms-3">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/js/layouts/navbar.js','resources/js/app.js', 'resources/css/glass.css'])
    @push('script-internal')
</body>
</html>
