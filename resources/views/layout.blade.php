
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Mahadata</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">MAHADATA</span>

            <div>
                <a class="btn btn-outline-light btn-sm" href="{{ route('home') }}">HOME</a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('admin.index') }}">ADMIN</a>
            </div>
        </div>
    </nav>

    <!-- KONTEN -->
    <main class="container flex-grow-1">

        @if (session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
        @endif

        @yield('isi')

    </main>

    <!-- FOOTER -->
    @include('footer')

</body>
</html>
