<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    {{-- Archivos CSS --}}
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/mejora.css') }}" rel="stylesheet" />

    <title>@yield('title', 'Tech Store ⚡')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">

    {{-- Iconos y Fuentes --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home.index') }}">
                ⚡ TECH STORE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    {{-- Rutas corregidas según tu web.php --}}
                    {{-- Solo mostramos el saldo si el usuario está autenticado --}}
                    @auth
                        <a class="nav-link active text-success fw-bold" href="{{ route('balance.index') }}">
                            <i class="bi bi-cash-stack"></i> ${{ number_format(Auth::user()->getBalance(), 2) }}
                        </a>
                    @endauth
                    <a class="nav-link active" href="{{ route('home.index') }}">🏠 Home</a>
                    <a class="nav-link active" href="{{ route('product.index') }}">💻 Products</a>
                    <a class="nav-link active" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart3"></i> Cart
                    </a>
                    <a class="nav-link active" href="{{ route('about.index') }}">ℹ️ About</a>

                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>

                    @guest
                        <a class="nav-link active" href="{{ route('login') }}">🔑 Login</a>
                        <a class="nav-link active" href="{{ route('register') }}">📝 Register</a>
                    @else
                        {{-- Ruta corregida de My Orders --}}
                        <a class="nav-link active" href="{{ route('myorders.index') }}">📦 My Orders</a>

                        <form id="logout" action="{{ route('logout') }}" method="POST" class="d-inline">
                            <a role="button" class="nav-link active text-warning"
                                onclick="document.getElementById('logout').submit();">
                                🚪 Logout
                            </a>
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <header class="masthead bg-primary text-white text-center py-5 shadow">
        <div class="container d-flex align-items-center flex-column">
            <h2 class="fw-light">@yield('subtitle', 'Tu portal tecnológico de confianza')</h2>
        </div>
    </header>
    <main class="container my-5 min-vh-100">
        @yield('content')
    </main>

    <footer class="footer py-4 text-center text-white bg-dark">
        <div class="container">
            <div class="mb-2">
                <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-instagram"></i></a>
            </div>
            <small>
                Copyright &copy; {{ date('Y') }} -
                <span class="fw-bold">Tech Store Team</span> 🛰️
            </small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>
