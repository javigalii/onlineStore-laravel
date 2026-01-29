<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importamos los Controladores (para usar la sintaxis moderna [Clase::class, 'metodo'])
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rutas de Autenticación (Con verificación activada)
Auth::routes(['verify' => true]);

// 2. Rutas Públicas (Cualquiera puede verlas)
Route::get('/', [HomeController::class, 'index'])->name("home.index");
Route::get('/about', [HomeController::class, 'about'])->name("about.index");

// Productos
Route::get('/products', [ProductController::class, 'index'])->name("product.index");
Route::get('/products/{id}', [ProductController::class, 'show'])->name("product.show");

// Carrito (Generalmente se permite añadir/ver sin estar logueado, se pide login al pagar)
Route::get('/cart', [CartController::class, 'index'])->name("cart.index");
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name("cart.add");
Route::get('/cart/delete', [CartController::class, 'delete'])->name("cart.delete");


// 3. Rutas para Usuarios Verificados
// Aquí aplicamos 'auth' Y 'verified'. Si no han verificado el email, no entran aquí.
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Compras y Cuenta
    Route::get('/cart/purchase', [CartController::class, 'purchase'])->name("cart.purchase");
    Route::get('/my-account/orders', [MyAccountController::class, 'orders'])->name("myorders.index");
    
    // Comentarios (Movido aquí para evitar spam de cuentas falsas)
    Route::post('/products/{id}/comment', [CommentController::class, 'store'])->name("comment.store");
});


// 4. Rutas de Administrador
Route::middleware(['auth', 'admin'])->group(function () { // Se recomienda añadir 'auth' antes de 'admin' por seguridad
    Route::get('/admin', [AdminHomeController::class, 'index'])->name("admin.home.index");
    
    // Gestión de Productos
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name("admin.product.index");
    Route::post('/admin/products/store', [AdminProductController::class, 'store'])->name("admin.product.store");
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', [AdminProductController::class, 'update'])->name("admin.product.update");
    Route::delete('/admin/products/{id}/delete', [AdminProductController::class, 'delete'])->name("admin.product.delete");
});