<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderProcessed;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];

        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }

        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] =  "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["products"] = $productsInCart;
        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id)
    {
        $products = $request->session()->get("products");
        $products[$id] = $request->input('quantity');
        $request->session()->put('products', $products);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    public function purchase(Request $request)
{
    $productsInSession = $request->session()->get("products");

    if ($productsInSession) {
        $user = Auth::user();
        $productsInCart = Product::findMany(array_keys($productsInSession));
        
        // 1. Calcular el total antes de procesar nada
        $total = 0;
        foreach ($productsInCart as $product) {
            $quantity = $productsInSession[$product->getId()];
            $total += ($product->getPrice() * $quantity);
        }

        // 2. CONTROL DE SALDO: Validar si el usuario tiene dinero suficiente
        if ($user->getBalance() < $total) {
            // Redirigir con un mensaje de error
            return redirect()->route('cart.index')->with('error', 'No tienes saldo suficiente para completar la compra.');
        }

        // 3. Si tiene saldo, procedemos a crear el pedido
        $order = new Order();
        $order->setUserId($user->getId());
        $order->setTotal($total);
        $order->save();
        Mail::to($request->user()->email)->send(new OrderProcessed($order));

        foreach ($productsInCart as $product) {
            $quantity = $productsInSession[$product->getId()];
            $item = new Item();
            $item->setQuantity($quantity);
            $item->setPrice($product->getPrice());
            $item->setProductId($product->getId());
            $item->setOrderId($order->getId());
            $item->save();
        }

        // 4. Actualizar el saldo del usuario
        $newBalance = $user->getBalance() - $total;
        $user->setBalance($newBalance);
        $user->save();

        // 5. Limpiar carrito
        $request->session()->forget('products');

        $viewData = [
            "title" => "Purchase - Online Store",
            "subtitle" => "Purchase Status",
            "order" => $order
        ];
        return view('cart.purchase')->with("viewData", $viewData);
    } else {
        return redirect()->route('cart.index');
    }
}
}