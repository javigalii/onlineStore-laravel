@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

    <h2 class="mb-4 fw-bold"><i class="bi bi-bag-check-fill me-2"></i> Mis Pedidos</h2>

    @forelse ($viewData["orders"] as $order)
        <div class="card mb-5 border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <span class="fw-bold"><i class="bi bi-hash"></i> Pedido #{{ $order->getId() }}</span>
                <span class="badge bg-success text-uppercase p-2">📦 Completado</span>
            </div>

            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted small uppercase fw-bold">Fecha de Compra 📅</p>
                        <p class="fs-5">{{ $order->getCreatedAt() }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1 text-muted small uppercase fw-bold">Total Pagado 💰</p>
                        <p class="fs-4 fw-bold text-primary">${{ number_format($order->getTotal(), 2) }}</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-top">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="py-3">Item ID</th>
                                <th scope="col" class="py-3 text-start">Producto 💻</th>
                                <th scope="col" class="py-3 text-center">Precio Unitario</th>
                                <th scope="col" class="py-3 text-center">Cantidad</th>
                                <th scope="col" class="py-3 text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->getItems() as $item)
                                <tr>
                                    <td class="text-muted">#{{ $item->getId() }}</td>
                                    <td class="text-start">
                                        <a class="text-decoration-none fw-bold text-dark"
                                            href="{{ route('product.show', ['id' => $item->getProduct()->getId()]) }}">
                                            <i class="bi bi-arrow-right-short text-primary"></i>
                                            {{ $item->getProduct()->getName() }}
                                        </a>
                                    </td>
                                    <td class="text-center">${{ number_format($item->getPrice(), 2) }}</td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill bg-light text-dark border px-3">
                                            {{ $item->getQuantity() }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold">
                                        ${{ number_format($item->getPrice() * $item->getQuantity(), 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <div class="display-1 text-muted mb-4">
                <i class="bi bi-cart-x"></i>
            </div>
            <h3 class="text-secondary">Aún no has realizado compras 🛍️</h3>
            <p class="text-muted mb-4">¡Explora nuestros productos tecnológicos y estrena algo hoy mismo!</p>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg px-5 shadow-sm">
                Ir a la tienda
            </a>
        </div>
    @endforelse
@endsection
