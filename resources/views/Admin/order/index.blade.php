@extends('layouts.admin') {{-- O el layout que uses para el admin --}}
@section('title', $viewData['title'])
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-receipt me-2"></i> Gestión de Pedidos</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($viewData["orders"] as $order)
                            <tr>
                                <td class="px-4 fw-bold">#{{ $order->getId() }}</td>
                                <td>
                                    <div class="fw-bold">{{ $order->user->getName() }}</div>
                                    <small class="text-muted">{{ $order->user->getEmail() }}</small>
                                </td>
                                <td>{{ $order->getCreatedAt() }}</td>
                                <td class="fw-bold text-success">${{ number_format($order->getTotal(), 2) }}</td>
                                <td>
                                    {{-- Aquí mostramos los productos que hay en cada pedido --}}
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach ($order->items as $item)
                                            <li><i class="bi bi-dot"></i> {{ $item->product->getName() }}
                                                (x{{ $item->getQuantity() }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">No hay pedidos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
