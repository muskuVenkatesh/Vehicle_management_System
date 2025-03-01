@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        <div class="sidebar-heading">Admin Panel</div>
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>

            {{-- <a href="{{ route('admin.vehicles') }}" class="list-group-item">
                <i class="fa fa-car"></i> Manage Vehicles
            </a> --}}

            <a href="{{ route('users.index') }}" class="list-group-item">
                <i class="fa fa-users"></i> Manage Users
            </a>

            {{-- <a href="{{ route('admin.reports') }}" class="list-group-item">
                <i class="fa fa-chart-bar"></i> Reports
            </a> --}}

            <a href="{{ route('admin.permissions.index') }}" class="list-group-item">
                <i class="fa fa-shield-alt"></i> Permissions
            </a>

            {{-- <a href="{{ route('admin.settings') }}" class="list-group-item">
                <i class="fa fa-cogs"></i> Settings
            </a> --}}
        </div>

    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-dark" id="menu-toggle">☰</button>
            <div class="ms-auto">
                <span class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</span>
            </div>
        </nav>

        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h4>Total Vehicles</h4>
                            <p>{{ $totalVehicles ?? 'Loading...' }} Vehicles</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h4>Total Users</h4>
                            <p class="fw-bold display-4">{{ $totalUsers ?? 'Loading...' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h4>Pending Bookings</h4>
                            <p>{{ $pendingBookings ?? 'Loading...' }} Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h4>Revenue</h4>
                            <p>${{ $revenue ?? '0' }}</p>
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
    bottom: 0;
    background: #1b2a4e; /* Sleek dark blue */
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

.list-group {
    padding: 0;
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

/* Sidebar Toggle */
.toggled .sidebar {
    margin-left: -250px;
}

.toggled #page-content-wrapper {
    margin-left: 0;
}
</style>

<!-- Sidebar Toggle Script -->
<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("wrapper").classList.toggle("toggled");
    });
</script>
@endsection
