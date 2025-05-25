<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ffffff;
        }
        #sidebar {
            background-color: #ffffff;
        }
        .navbar {
            background-color: #ffffff;
        }
        /* Mengubah warna tombol menu sidebar */
        .nav-pills .nav-link {
            background-color: #ffffff !important; /* Warna tombol menu kuning */
            color: #212529 !important; /* Warna teks hitam */
            border-radius: 5px; /* Opsional: agar tombol sedikit melengkung */
        }
        .nav-pills .nav-link:hover,
        .nav-pills .nav-link.active {
            background-color: #212529 !important; /* Warna kuning yang lebih gelap saat aktif atau hover */
            color: #ffffff !important; /* Warna teks saat hover */
        }
        .btn-primary {
            background-color: #212529 !important; 
            border-color: #ffffff !important;
            color: rgb(255, 255, 255) !important;
        }
        .btn-primary:hover {
            background-color: #ffffff !important;
            border-color: #212529 !important;
        }
        .nav-link {
            color: black !important;
        }
        .nav-link:hover {
            color: rgb(207, 0, 0) !important;
        }
        .dropdown-menu {
            background-color: #fffcce;
        }
        .dropdown-item {
            color: rgb(89, 89, 89);
        }
        .dropdown-item:hover {
            background-color: rgb(104, 101, 101);
            color: white;
        }
    </style>
    
    
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
    
        {{-- <div id="sidebar" class="d-flex flex-column flex-shrink-0 bg-light vh-100 p-3 d-none" style="width: 250px;"> --}}
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 bg-light vh-100 p-3 d-none" style="width: 250px;">

            <h4 class="text-center">MENU</h4>
            <ul class="nav nav-pills flex-column mb-auto" id="SidebarMenu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.images.index') }}" class="nav-link">Kelola content</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.notif.index') }}" class="nav-link">Notif</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-md btn-info shadow-sm px-4">
                <div class="container-fluid">
                    <!-- Tombol Toggle Sidebar -->
                    <button id="toggleSidebar" class="btn btn-primary me-3" id="toggleSidebar">☰</button>
                    
                    <a class="navbar-brand" href="#"><strong>DASHBOARD</strong></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" data-bs-toggle="dropdown">
                                    Hello, {{ Auth::guard('admin')->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
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
    @vite(['resources/js/layouts/navbar.js'])
    @push('script-internal')
</body>
</html>



    {{-- <script>
        // Toggle sidebar saat tombol ☰ ditekan
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            let sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('d-none');
        });

        // Highlight menu sidebar yang sedang aktif
        document.addEventListener('DOMContentLoaded', function(){
            const navLinks = document.querySelectorAll("#SidebarMenu .nav-link");
            navLinks.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add("active", "bg-primary", "text-white");
                }
                link.addEventListener("click", function(){
                    navLinks.forEach(nav => nav.classList.remove("active", "bg-primary", "text-white"));
                    this.classList.add("active", "bg-primary", "text-white");
                });
            });
        });
    </script> --}}
     
