@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

    {{-- Tarjetas de Resumen --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="mb-1">Ingresos Totales</p>
                        <h2 class="mb-0 fw-bold">${{ number_format($viewData['total_sales'], 2) }}</h2>
                    </div>
                    <i class="bi bi-currency-dollar fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="mb-1">Pedidos Realizados</p>
                        <h2 class="mb-0 fw-bold">{{ $viewData['orders_count'] }}</h2>
                    </div>
                    <i class="bi bi-cart-check fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="mb-1">Productos en Catálogo</p>
                        <h2 class="mb-0 fw-bold">{{ $viewData['products_count'] }}</h2>
                    </div>
                    <i class="bi bi-box-seam fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de Gráfico --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">
                    <i class="bi bi-graph-up me-2"></i> Rendimiento de Ventas (Últimos Pedidos)
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold">
                    Panel de Control
                </div>
                <div class="card-body">
                    <p>Bienvenido al panel de administración de <strong>Tech Store</strong>. Aquí puedes ver el estado
                        global de tu negocio.</p>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-dark w-100 mb-2">Ver todos los
                        pedidos</a>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary w-100">Gestionar Productos</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Script para el Gráfico --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line', // Cambiado a línea para que se vea mejor con muchos datos
            data: {
                labels: {!! json_encode($viewData['latest_orders']->pluck('id')->map(fn($id) => "#$id")) !!},
                datasets: [{
                    label: 'Historial de Ventas ($)',
                    data: {!! json_encode($viewData['latest_orders']->pluck('total')) !!},
                    backgroundColor: 'rgba(29, 26, 188, 0.2)',
                    borderColor: 'rgba(29, 26, 188, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    </script>

@endsection
