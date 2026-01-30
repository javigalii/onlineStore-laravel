<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];
        $quantities = [];

        if (Auth::check()) {
            // SI ESTÁ LOGUEADO: Sacamos de la Base de Datos
            $dbItems = CartItem::where('user_id', Auth::id())->get();
            if ($dbItems->count() > 0) {
                $productsInCart = Product::findMany($dbItems->pluck('product_id'));
                // Creamos un array de [id => cantidad] para que el método sumPrices funcione igual
                foreach ($dbItems as $item) {
                    $quantities[$item->product_id] = $item->quantity;
                }
                $total = Product::sumPricesByQuantities($productsInCart, $quantities);
            }
        } else {
            // SI ES INVITADO: Sacamos de la Sesión (tu código original)
            $productsInSession = $request->session()->get("products");
            if ($productsInSession) {
                $productsInCart = Product::findMany(array_keys($productsInSession));
                $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
                $quantities = $productsInSession;
            }
        }

        $viewData = [
            "title" => "Cart - Online Store",
            "subtitle" => "Shopping Cart",
            "total" => $total,
            "products" => $productsInCart,
            "quantities" => $quantities 
        ];
        
        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id)
{
    // Forzamos que la cantidad sea un número entero
    $quantity = (int)$request->input('quantity', 1);

    if (Auth::check()) {
        // Buscamos si ya existe el producto en el carrito del usuario
        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $id)
                            ->first();

        if ($cartItem) {
            // Si existe, sumamos la cantidad de forma manual (evita el error de DB::raw)
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Si no existe, lo creamos
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => $quantity,
            ]);
        }
    } else {
        // PERSISTENCIA EN SESIÓN (Para invitados)
        $products = $request->session()->get("products", []);
        $products[$id] = ($products[$id] ?? 0) + $quantity;
        $request->session()->put('products', $products);
    }

    return redirect()->route('cart.index');
}

    public function delete(Request $request)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        }
        
        $request->session()->forget('products');
        return back();
    }

    public function purchase(Request $request)
    {
        // Determinamos qué datos usar para la compra
        if (Auth::check()) {
            $dbItems = CartItem::where('user_id', Auth::id())->get();
            $productsInPurchase = $dbItems->pluck('quantity', 'product_id')->toArray();
        } else {
            $productsInPurchase = $request->session()->get("products");
        }

        if ($productsInPurchase) {
            $user = Auth::user();
            $productsInCart = Product::findMany(array_keys($productsInPurchase));
            
            $total = 0;
            foreach ($productsInCart as $product) {
                $quantity = $productsInPurchase[$product->getId()];
                $total += ($product->getPrice() * $quantity);
            }

            if ($user->getBalance() < $total) {
                return redirect()->route('cart.index')->with('error', 'No tienes saldo suficiente.');
            }

            $order = new Order();
            $order->setUserId($user->getId());
            $order->setTotal($total);
            $order->save();

            // Envío de mails
            Mail::to($user->getEmail())->send(new OrderShipped($order));
            Mail::raw('Administrador te han hecho un pedido', function($message){
                $message->to('galianpinerojavier@gmail.com')->subject('Pedido hecho');            
            });

            foreach ($productsInCart as $product) {
                $quantity = $productsInPurchase[$product->getId()];
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
            }

            // Actualizar saldo
            $user->setBalance($user->getBalance() - $total);
            $user->save();

            // LIMPIAR TODO
            if (Auth::check()) {
                CartItem::where('user_id', Auth::id())->delete();
            }
            $request->session()->forget('products');

            $viewData = [
                "title" => "Purchase - Online Store",
                "subtitle" => "Purchase Status",
                "order" => $order
            ];
            return view('cart.purchase')->with("viewData", $viewData);
        }

        return redirect()->route('cart.index');
    }
}