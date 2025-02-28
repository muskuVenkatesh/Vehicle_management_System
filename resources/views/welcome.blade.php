<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle Booking App</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styles */
        .hero-section {
            background: url('{{ asset('images/herocar1.jpeg') }}') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-overlay {
            background: rgba(0, 0, 0, 0.6);
            padding: 3rem;
            border-radius: 10px;
        }

        .feature-img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light text-dark">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="#">Vehicle Booking App</a>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Dashboard</a>
                    @else
                        <a href="{{ url('login') }}" class="btn btn-outline-dark">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay">
            <h1 class="display-4 fw-bold">Book Your Ride in Seconds!</h1>
            <p class="lead">Find, reserve, and enjoy hassle-free vehicle booking anytime, anywhere.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Book Now</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <h3 class="text-center fw-bold">Our Features</h3>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <img src="{{ asset('images/booking-feature.jpg') }}" class="card-img-top feature-img">
                    <div class="card-body">
                        <h5 class="card-title">Easy Online Booking</h5>
                        <p class="card-text">Book your slots hassle-free anytime, anywhere.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <img src="{{ asset('images/secure-payment.jpg') }}" class="card-img-top feature-img">
                    <div class="card-body">
                        <h5 class="card-title">Secure Payments</h5>
                        <p class="card-text">Make fast and secure payments with multiple options.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <img src="{{ asset('images/instant-notification.jpg') }}" class="card-img-top feature-img">
                    <div class="card-body">
                        <h5 class="card-title">Instant Notifications</h5>
                        <p class="card-text">Get real-time booking confirmations and reminders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; {{ date('Y') }} Vehicle Management System. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
