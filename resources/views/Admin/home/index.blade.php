@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Gestión de Pedidos 📦</h4>
            <span class="badge bg-primary">{{ $viewData['orders']->count() }} Pedidos Totales</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Detalles del Pedido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($viewData["orders"] as $order)
                            <tr>
                                <td><strong>#{{ $order->getId() }}</strong></td>
                                <td>{{ $order->getUser()->getName() }}</td>
                                <td>{{ $order->getUser()->getEmail() }}</td>
                                <td>{{ $order->getCreatedAt()->format('d/m/Y H:i') }}</td>
                                <td class="fw-bold text-success">${{ number_format($order->getTotal(), 2) }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach ($order->getItems() as $item)
                                            <li>
                                                <i class="bi bi-caret-right-fill text-muted"></i>
                                                {{ $item->getProduct()->getName() }} (x{{ $item->getQuantity() }})
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No hay pedidos registrados aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
