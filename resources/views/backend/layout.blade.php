<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Title -->
    <title>Admin Dashboard - Toko Batik</title>
    <!-- {{-- Bootstrap & Bootstrap icons--}} -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/style.min.css') }}">

    <style>
        body {
            background-color: #f5f6fa;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #1e1e2d;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #bdbdc7;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #2d2d3f;
            color: white;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0px 2px 6px #0000001a;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<!-- {{-- SIDEBAR --}} -->
<aside class="sidebar">
    <!-- Scroll Sidebar -->
    <div class="scroll-sidebar">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('beranda') }}">
            <img src="{{ asset('images/logo.png') }}" alt="My Batik" style="height: 40px; margin-right: 10px;">
            <span class="ms-1">MyBatik</span>
        </a>
    
        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="bi bi-receipt me-2"></i> List Pesanan
        </a>
    
        <a href="{{ route('admin.produk') }}" class="{{ request()->routeIs('admin.produk') ? 'active' : '' }}">
            <i class="bi bi-bag me-2"></i> Produk
        </a>

        <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="bi bi-tags me-2"></i> Kategori
        </a>

        <a href="{{ route('admin.ratings.index') }}" class="{{ request()->routeIs('admin.ratings.*') ? 'active' : '' }}">
            <i class="bi bi-star me-2"></i> Rating
        </a>
    
        <a href="{{ route('admin.pelanggan') }}" class="{{ request()->routeIs('admin.pelanggan') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Pelanggan
        </a>
    
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('keluar-app').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
        <!-- {{-- Form Logout --}} -->
        <form id="keluar-app" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>

<!-- {{-- CONTENT --}} -->
<div class="main-content">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- {{-- page content --}} -->
    <div class="card p-4 shadow-sm">
        @yield('content')
    </div>

</div>

<style>
.grid-2 {
    display: grid;
    grid-template-columns: repeat(2, max-content);
    gap: 6px;
}
</style>


</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    timer: 1600,
    showConfirmButton: false
});
</script>
@endif


</html>
