<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Portals')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-primary text-white py-3 mb-4">
        <div class="container">
            <h1 class="h3">Patient Portals</h1>
            <nav>
                <a href="{{ route('homepage') }}" class="text-white me-3">Home</a>
                <a href="{{ route('health-records.index') }}" class="text-white me-3">Health Records</a>
                <a href="{{ route('appointments.index') }}" class="text-white">Appointments</a>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <p>&copy; {{ date('Y') }} Patient Portals</p>
    </footer>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>