@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0" style="border-radius: 20px;">
                    <div class="card-body p-5 text-center">
                        <i class="bi bi-wallet2 display-1 text-primary mb-3"></i>
                        <h2 class="fw-bold">Mi Saldo Actual</h2>
                        <h1 class="display-3 fw-bold text-success">${{ number_format($viewData['balance'], 2) }}</h1>

                        <hr class="my-4">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('balance.add') }}" method="POST">
                            @csrf
                            <div class="mb-3 text-start">
                                <label class="form-label fw-bold">Cantidad a recargar ($)</label>
                                <input type="number" name="amount" class="form-control form-control-lg"
                                    placeholder="Ej: 50" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                                Recargar ahora <i class="bi bi-plus-circle ms-1"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
