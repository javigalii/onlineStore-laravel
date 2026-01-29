<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Este método se ejecuta automáticamente tras un login exitoso.
     */
    protected function authenticated(Request $request, $user)
    {
        // 1. Obtenemos los productos que el usuario eligió como invitado
        $sessionCart = session()->get('products', []); 

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $quantity) {
                // 2. Buscamos si el producto ya existe en su carrito de la BD
                $cartItem = CartItem::where('user_id', $user->id)
                                    ->where('product_id', $productId)
                                    ->first();

                if ($cartItem) {
                    // SI YA EXISTE: Actualizamos la cantidad con la de la sesión
                    // (O podrías sumarlas si prefieres, pero esto evita duplicados visuales)
                    $cartItem->quantity = $quantity; 
                    $cartItem->save();
                } else {
                    // SI NO EXISTE: Lo creamos nuevo
                    CartItem::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $quantity
                    ]);
                }
            }
            
            // 3. MUY IMPORTANTE: Limpiar la sesión para que no se procese dos veces
            session()->forget('products');
        }

        // 4. Redirigir a la página deseada
        return redirect()->intended($this->redirectPath());
    }
}