@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        <div class="sidebar-heading">Driver Panel</div>
        <div class="list-group">
            <a href="{{ route('driver.dashboard') }}" class="list-group-item">
                <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('driver.assignedBookings') }}" class="list-group-item">
                <i class="fa fa-clipboard-list"></i> Assigned Bookings
            </a>
            <a href="{{ route('driver.manageTrips') }}" class="list-group-item">
                <i class="fa fa-route"></i> Manage Trips
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
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h4>Assigned Rides</h4>
                            <p class="fw-bold display-4">{{ $assignedBookings ?? '0' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h4>Trips Managed</h4>
                            <p class="fw-bold display-4">{{ $managedTrips ?? '0' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        });
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
</script>
@endsection
