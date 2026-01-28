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
                    {{-- Mejora: Compartir en Redes Sociales --}}
                    <div class="share-section mt-4 mb-4">
                        <p class="fw-bold small text-uppercase text-muted mb-2">Compartir producto:</p>
                        <div class="d-flex gap-2">
                            <a href="https://api.whatsapp.com/send?text=¡Mira este producto en Tech Store! {{ urlencode($viewData['product']->getName()) }}: {{ Request::fullUrl() }}"
                                target="_blank" class="btn btn-sm btn-success shadow-sm">
                                <i class="bi bi-whatsapp"></i>
                            </a>

                            <a href="https://twitter.com/intent/tweet?text=Echa un vistazo a este {{ urlencode($viewData['product']->getName()) }} en Tech Store&url={{ Request::fullUrl() }}"
                                target="_blank" class="btn btn-sm btn-dark shadow-sm">
                                <i class="bi bi-twitter-x"></i>
                            </a>

                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}" target="_blank"
                                class="btn btn-sm btn-primary shadow-sm">
                                <i class="bi bi-facebook"></i>
                            </a>

                            <button onclick="copyToClipboard()" class="btn btn-sm btn-secondary shadow-sm"
                                title="Copiar enlace">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>
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
                    {{-- Sección de Comentarios --}}
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header bg-dark text-white">Comentarios de Clientes 💬</div>
                        <div class="card-body">
                            @forelse($viewData["product"]->comments as $comment)
                                <div class="border-bottom mb-3 pb-2">
                                    <span class="fw-bold text-primary">{{ $comment->user->getName() }}</span>
                                    <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                    <p class="mb-0">{{ $comment->description }}</p>
                                </div>
                            @empty
                                <p class="text-muted">Sé el primero en opinar sobre este producto.</p>
                            @endforelse

                            @auth
                                <form action="{{ route('comment.store', $viewData['product']->getId()) }}" method="POST"
                                    class="mt-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deja tu opinión:</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="¿Qué te pareció este producto?"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Publicar Comentario</button>
                                </form>
                            @else
                                <div class="alert alert-info mt-3">
                                    Debes <a href="{{ route('login') }}">iniciar sesión</a> para comentar.
                                </div>
                            @endauth
                        </div>
                    </div>

                    <div class="mt-5 d-flex gap-3">
                        <small class="text-muted"><i class="bi bi-truck"></i> Free Shipping</small>
                        <small class="text-muted"><i class="bi bi-shield-check"></i> 2 Year Warranty</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
