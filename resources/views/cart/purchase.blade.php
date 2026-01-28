@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card border-0 shadow-lg p-5" style="border-radius: 25px;">
                    <div class="card-body">
                        {{-- Icono de Éxito Animado --}}
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        </div>

                        <h1 class="fw-bold mb-3">¡Pedido Confirmado! 🎉</h1>
                        <p class="text-muted fs-5 mb-4">
                            Gracias por confiar en <b>Tech Store</b>. Tu pedido ha sido procesado con éxito y ya estamos
                            preparando tus nuevos gadgets.
                        </p>

                        {{-- Caja de Información del Pedido --}}
                        <div class="bg-light p-4 rounded-4 mb-5 border">
                            <div class="row">
                                <div class="col-sm-6 text-sm-start">
                                    <span class="text-muted small text-uppercase fw-bold">Número de Pedido</span>
                                    <h4 class="fw-bold">#{{ $viewData['order']->getId() }}</h4>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <span class="text-muted small text-uppercase fw-bold">Total Pagado 💸</span>
                                    <h4 class="fw-bold text-primary">${{ number_format($viewData['order']->getTotal(), 2) }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a href="{{ route('myorders.index') }}" class="btn btn-outline-dark btn-lg px-4">
                                <i class="bi bi-box-seam me-2"></i> Ver mis pedidos
                            </a>
                            <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                                <i class="bi bi-cart-plus me-2"></i> Seguir comprando
                            </a>
                        </div>

                        {{-- Detalle Extra --}}
                        <div class="mt-5 text-muted small">
                            <p><i class="bi bi-envelope-check"></i> Hemos enviado un correo con los detalles de tu compra.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
