@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

    <div class="row" id="product-grid">
        @foreach ($viewData['products'] as $product)
            <div class="col-md-4 col-lg-3 mb-4 product-item">
                <div class="card h-100 shadow-sm border-0">
                    {{-- Imagen con un contenedor para asegurar proporciones --}}
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('/storage/' . $product->getImage()) }}" class="card-img-top img-card p-3"
                            alt="{{ $product->getName() }}">
                        <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-info text-dark">
                            New ⚡
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-truncate">{{ $product->getName() }}</h5>
                        <p class="card-text text-primary fs-5 fw-bold">
                            💰 ${{ number_format($product->getPrice(), 2) }}
                        </p>

                        {{-- Espaciador para empujar el botón al final si los nombres varían de tamaño --}}
                        <div class="mt-auto">
                            <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                                class="btn btn-primary w-100 py-2">
                                <i class="bi bi-eye-fill me-2"></i> Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Centinela para el scroll infinito --}}
    <div id="pagination-sentinel" class="py-4">
        <div id="loading-spinner" class="text-center" style="display: none;">
            <div class="spinner-grow text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="text-muted mt-2">✨ Buscando más tecnología para ti...</p>
        </div>
    </div>

    {{-- Paginación oculta --}}
    <div id="hidden-pagination" style="display: none;">
        {{ $viewData['products']->links() }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let grid = document.getElementById('product-grid');
            let sentinel = document.getElementById('pagination-sentinel');
            let spinner = document.getElementById('loading-spinner');
            let isFetching = false;

            const observer = new IntersectionObserver((entries) => {
                let nextLink = document.querySelector('#hidden-pagination a[rel="next"]');
                let nextPageUrl = nextLink ? nextLink.href : null;

                if (entries[0].isIntersecting && nextPageUrl && !isFetching) {
                    loadMore(nextPageUrl);
                }
            }, {
                rootMargin: '200px'
            });

            observer.observe(sentinel);

            function loadMore(url) {
                isFetching = true;
                spinner.style.display = 'block';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newItems = doc.querySelectorAll('.product-item');
                        newItems.forEach(item => {
                            // Añadimos una pequeña animación de entrada
                            item.style.opacity = '0';
                            grid.appendChild(item);
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transition = 'opacity 0.5s';
                            }, 10);
                        });

                        const newPaginationHtml = doc.querySelector('#hidden-pagination').innerHTML;
                        document.getElementById('hidden-pagination').innerHTML = newPaginationHtml;

                        isFetching = false;
                        spinner.style.display = 'none';
                    })
                    .catch(error => {
                        console.error("Error cargando productos:", error);
                        isFetching = false;
                        spinner.style.display = 'none';
                    });
            }
        });
    </script>
@endsection
