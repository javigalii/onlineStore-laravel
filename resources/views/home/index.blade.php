@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    {{-- Sección de Bienvenida --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Bienvenido a Tech Store ⚡</h1>
        <p class="lead">La mejor tecnología a un solo clic.</p>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('/img/game.png') }}" class="card-img-top img-fluid rounded">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Gaming</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('/img/safe.png') }}" class="card-img-top img-fluid rounded">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Seguridad</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('/img/submarine.png') }}" class="card-img-top img-fluid rounded">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Exploración</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">Ver Catálogo de Productos</a>
    </div>
@endsection
