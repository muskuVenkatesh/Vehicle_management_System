@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        <div class="sidebar-heading">Customer Panel</div>
        <div class="list-group">
            <a href="{{ route('customer.dashboard') }}" class="list-group-item">
                <i class="fa fa-home"></i> Dashboard
            </a>
            <a href="{{ route('customer.bookings.create') }}" class="list-group-item">
                <i class="fa fa-car"></i> Book a Vehicle
            </a>
            <a href="{{ route('customer.bookings.index') }}" class="list-group-item">
                <i class="fa fa-list"></i> My Bookings
            </a>
            <a href="{{ route('customer.profile') }}" class="list-group-item">
                <i class="fa fa-user"></i> Manage Profile
            </a>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-dark" id="menu-toggle">☰</button>
            <div class="ms-auto">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('customer.profile') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="logoutUser()">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h4>Total Bookings</h4>
                            <p>{{ $totalBookings ?? 'Loading...' }} Bookings</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h4>Pending Bookings</h4>
                            <p>{{ $pendingBookings ?? 'Loading...' }} Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h4>Completed Bookings</h4>
                            <p>{{ $completedBookings ?? 'Loading...' }} Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar & Page Styling -->
<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

#wrapper {
    display: flex;
}

.sidebar {
    width: 250px;
    min-height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: #1b2a4e;
    color: #fff;
    padding-top: 20px;
    transition: all 0.3s;
}

.sidebar-heading {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    padding-bottom: 20px;
}

.list-group-item {
    background: none;
    color: #fff;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    transition: background 0.3s, padding-left 0.3s;
}

.list-group-item:hover {
    background: rgba(255, 255, 255, 0.1);
    padding-left: 25px;
}

#page-content-wrapper {
    margin-left: 250px;
    flex-grow: 1;
    padding: 20px;
    transition: margin-left 0.3s;
}

.toggled .sidebar {
    margin-left: -250px;
}

.toggled #page-content-wrapper {
    margin-left: 0;
}
</style>

<!-- Sidebar Toggle & Logout Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("wrapper").classList.toggle("toggled");
    });

    function logoutUser() {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, Logout!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
