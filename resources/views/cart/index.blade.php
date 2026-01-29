@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

    {{-- Bloque de error para saldo insuficiente --}}
    @if (session('error'))
        <div class="alert alert-danger shadow-sm border-start border-danger border-4 d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-octagon-fill fs-4 me-3"></i>
            <div>
                <strong>¡Ups! Saldo insuficiente.</strong> {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-cart-check-fill me-2 text-primary"></i> Tu Carrito de Compras</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="py-3">ID</th>
                            <th scope="col" class="py-3 text-start">Producto 📦</th>
                            <th scope="col" class="py-3">Precio</th>
                            <th scope="col" class="py-3">Cantidad</th>
                            <th scope="col" class="py-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($viewData['products'] as $product)
                            @php
                                // Extraemos la cantidad del array que enviamos desde el controlador
                                $productId = $product->getId();
                                $quantity = $viewData['quantities'][$productId] ?? 0;
                            @endphp
                            <tr>
                                <td class="text-muted">#{{ $productId }}</td>
                                <td class="text-start fw-bold">{{ $product->getName() }}</td>
                                <td>${{ number_format($product->getPrice(), 2) }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-info text-dark px-3">{{ $quantity }}</span>
                                </td>
                                <td class="fw-bold text-primary">
                                    ${{ number_format($product->getPrice() * $quantity, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-muted">
                                    <i class="bi bi-cart-x display-4 d-block mb-3"></i>
                                    Tu carrito está vacío. ¡Añade algo de tecnología!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Resumen y Acciones --}}
            <div class="p-4 bg-light border-top">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        @if (count($viewData['products']) > 0)
                            <a href="{{ route('cart.delete') }}" class="text-danger text-decoration-none small fw-bold">
                                <i class="bi bi-trash3-fill me-1"></i> Vaciar mi carrito
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="mb-3">
                            <span class="text-muted text-uppercase small fw-bold">Total a pagar:</span>
                            <h3 class="fw-bold text-dark d-inline ms-2">${{ number_format($viewData['total'], 2) }}</h3>
                        </div>

                        @if (count($viewData['products']) > 0)
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary px-4">
                                    Seguir comprando
                                </a>
                                <a href="{{ route('cart.purchase') }}" class="btn btn-primary btn-lg px-5 shadow-sm">
                                    Finalizar Compra <i class="bi bi-credit-card-2-front ms-2"></i>
                                </a>
                            </div>
                        @else
                            <a href="{{ route('product.index') }}" class="btn btn-primary px-5">Ver productos</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
