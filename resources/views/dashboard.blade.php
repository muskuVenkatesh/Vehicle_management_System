@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        <div class="sidebar-heading">Vehicle Booking</div>
        <div class="list-group">
            <a href="#" class="list-group-item">Dashboard</a>
            <a href="#" class="list-group-item">Book Vehicle</a>
            <a href="#" class="list-group-item">My Bookings</a>
            <a href="#" class="list-group-item">Settings</a>
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
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h4>Available Vehicles</h4>
                            <p>10 Vehicles</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h4>My Bookings</h4>
                            <p>3 Active Bookings</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h4>Pending Requests</h4>
                            <p>2 Pending</p>
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
