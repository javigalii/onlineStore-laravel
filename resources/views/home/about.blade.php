@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="container py-4">
        {{-- Tarjeta de Presentación --}}
        <div class="card border-0 shadow-lg mb-5" style="border-radius: 20px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-lg-6 bg-primary text-white d-flex align-items-center p-5">
                    <div>
                        <h2 class="display-5 fw-bold mb-4">¿Quiénes somos? 🚀</h2>
                        <p class="lead" style="line-height: 1.8;">
                            {{ $viewData['description'] }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 bg-white p-5 d-flex align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark mb-3"><i class="bi bi-person-badge text-primary me-2"></i> Nuestro
                            Equipo</h4>
                        <p class="text-muted mb-4">
                            Liderado con pasión por <strong>{{ $viewData['author'] }}</strong>, nuestro equipo trabaja día a
                            día para traerte lo mejor de la tecnología mundial.
                        </p>
                        <div class="d-flex gap-3">
                            <span class="badge bg-light text-dark p-2 border"><i class="bi bi-cpu me-1"></i>
                                Innovación</span>
                            <span class="badge bg-light text-dark p-2 border"><i class="bi bi-shield-check me-1"></i>
                                Confianza</span>
                            <span class="badge bg-light text-dark p-2 border"><i class="bi bi-truck me-1"></i>
                                Rapidez</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección de Ubicación --}}
        <div class="text-center mb-4">
            <h3 class="fw-bold"><i class="bi bi-geo-alt-fill text-danger"></i> Visítanos en nuestra sede</h3>
            <p class="text-muted">Estamos ubicados en el corazón tecnológico de la ciudad.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 shadow-sm p-2 bg-white rounded-4 overflow-hidden border">
                {{-- Mapa real de Google Maps (Placeholder funcional) --}}
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3102.788713933425!2d-0.376288!3d39.469907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMznCsDI4JzExLjciTiAwwrAyMicyMi42Ilc!5e0!3m2!1ses!2ses!4v1700000000000!5m2!1ses!2ses"
                    width="100%" height="450" style="border:0; border-radius: 15px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        {{-- Footer de Contacto Rápido --}}
        <div class="row text-center mt-5">
            <div class="col-md-4">
                <i class="bi bi-envelope-at fs-1 text-primary mb-2"></i>
                <h5>Email</h5>
                <p class="text-muted">contacto@techstore.com</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-telephone-outbound fs-1 text-primary mb-2"></i>
                <h5>Teléfono</h5>
                <p class="text-muted">+34 900 123 456</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-chat-dots fs-1 text-primary mb-2"></i>
                <h5>Soporte 24/7</h5>
                <p class="text-muted">Chat en vivo disponible</p>
            </div>
        </div>
    </div>
@endsection
