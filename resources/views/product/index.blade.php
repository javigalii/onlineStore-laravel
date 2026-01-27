@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

    <div class="row" id="product-grid">
        @foreach ($viewData['products'] as $product)
            <div class="col-md-4 col-lg-3 mb-2 product-item">
                <div class="card">
                    <img src="{{ asset('/storage/' . $product->getImage()) }}" class="card-img-top img-card">
                    <div class="card-body text-center">
                        <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                            class="btn bg-primary text-white">{{ $product->getName() }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="pagination-sentinel" style="height: 50px;"></div>

    <div id="loading-spinner" class="text-center my-3" style="display: none;">
        <div class="spinner-border text-primary" role="status"></div>
        <p>Cargando más productos...</p>
    </div>

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
                // Buscamos el link de "Siguiente" dentro del div de paginación
                let nextLink = document.querySelector('#hidden-pagination a[rel="next"]');
                let nextPageUrl = nextLink ? nextLink.href : null;

                if (entries[0].isIntersecting && nextPageUrl && !isFetching) {
                    loadMore(nextPageUrl);
                }
            }, {
                rootMargin: '100px'
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

                        // 1. Extraemos los nuevos productos y los añadimos al grid
                        const newItems = doc.querySelectorAll('.product-item');
                        newItems.forEach(item => grid.appendChild(item));

                        // 2. IMPORTANTE: Reemplazamos el contenido del div de paginación
                        // con el nuevo HTML recibido (que ahora tendrá el link a la página 3, luego 4...)
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
