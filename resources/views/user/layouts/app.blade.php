<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beevities')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('styles')

    <style>
        
        .navbar-brand,
        .nav-link {
            color: black !important;
            font-weight: 300;
        }

        .nav-link:hover {
            color: grey !important;
        }

        .logout-btn {
            padding: 6px 12px;
            border-radius: 5px;
        }

        #navbarNav {
            padding-left: 25rem;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('user.dashboard') }}">Beevities</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    {{-- Kiri --}}
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.dashboard') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('organizations.index') }}">Organizations</a></li>
                    </ul>

                    {{-- Kanan --}}
                    <ul class="navbar-nav ms-auto align-items-center">
                        @auth
                        <li class="nav-item pr-">
                            <span class="">Welcome {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.checkout.view') }}"><i class="bi bi-cart"></i></a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button><i class="bi bi-cart"></i></button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    @yield('scripts')
    @if(file_exists(public_path('js/app.js')))
    <script src="{{ mix('js/app.js') }}" defer></script>
    @else
    <script>
        console.error('ERROR: public/js/app.js not found');
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>