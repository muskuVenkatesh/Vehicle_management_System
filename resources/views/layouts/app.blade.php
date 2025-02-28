<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vehicle Booking')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <!-- Navbar -->
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href={{url('/')}}>Vehicle Booking App</a>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Dashboard</a>
                @else
                    @if (Route::currentRouteName() !== 'login')
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">Log in</a>
                    @endif
                    @if (Route::has('register') && Route::currentRouteName() !== 'register')
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>


    <!-- Page Content -->
    <div class="container mt-5 pt-5">
        @yield('content')
    </div>

    <!-- Footer -->
    {{-- <footer class="bg-dark text-white py-3 text-center mt-4">
        <p>&copy; {{ date('Y') }} Vehicle Booking App. All Rights Reserved.</p>
    </footer> --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
