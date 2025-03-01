<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vehicle Booking')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>

<body class="bg-light text-dark">


    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="{{ url('/') }}">Vehicle Booking App</a>
            <div>
                @if (Route::has('login'))
                    @auth
                        @php
                            $role = Auth::user()->getRoleNames()->first(); // Using Spatie Role package
                        @endphp
                        <a href="{{ route($role . '.dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @else
                        @if (!request()->routeIs('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-dark">Log in</a>
                        @endif
                        @if (Route::has('register') && !request()->routeIs('register'))
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
