@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')
    <div class="card mb-3 border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
        <div class="row g-0">
            {{-- Columna de la Imagen con zoom al pasar el ratón --}}
            <div class="col-md-5 bg-white d-flex align-items-center justify-content-center p-4">
                <img src="{{ asset('/storage/' . $viewData['product']->getImage()) }}"
                    class="img-fluid rounded-start transition-zoom" alt="{{ $viewData['product']->getName() }}"
                    style="max-height: 400px; object-fit: contain;">
            </div>

            {{-- Columna de Información --}}
            <div class="col-md-7">
                <div class="card-body p-5">
                    {{-- Badge de Categoría o Estado --}}
                    <span class="badge bg-primary-soft text-primary mb-2">
                        <i class="bi bi-cpu"></i> High Performance
                    </span>

                    <h2 class="card-title fw-bold display-6 mb-3">
                        {{ $viewData['product']->getName() }}
                    </h2>

                    <div class="d-flex align-items-center mb-4">
                        <h3 class="text-primary fw-bold mb-0 me-3">
                            ${{ number_format($viewData['product']->getPrice(), 2) }}
                        </h3>
                        <span class="text-success fw-bold small">
                            <i class="bi bi-check-circle-fill"></i> In Stock
                        </span>
                    </div>

                    <hr class="my-4 text-muted">

                    <p class="card-text text-secondary mb-4" style="line-height: 1.8;">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ $viewData['product']->getDescription() }}
                    </p>

                    <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label class="form-label fw-bold small mb-1">Quantity 🔢</label>
                                <div class="input-group" style="width: 140px;">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-plus-minus"></i></span>
                                    <input type="number" min="1" max="10"
                                        class="form-control border-0 bg-light text-center fw-bold" name="quantity"
                                        value="1">
                                </div>
                            </div>

                            <div class="col-auto align-self-end">
                                <button class="btn btn-primary px-4 py-2 shadow-sm" type="submit">
                                    <i class="bi bi-cart-plus-fill me-2"></i> Add to cart
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-5 d-flex gap-3">
                        <small class="text-muted"><i class="bi bi-truck"></i> Free Shipping</small>
                        <small class="text-muted"><i class="bi bi-shield-check"></i> 2 Year Warranty</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
