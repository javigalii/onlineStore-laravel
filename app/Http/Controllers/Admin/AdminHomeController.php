<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminHomeController extends Controller
{
    public function index()
{
    $viewData = [];
    $viewData["title"] = "Admin Page - Tech Store";
    
    // Aquí calculamos los datos que faltan
    $viewData["total_sales"] = \App\Models\Order::sum('total');
    $viewData["orders_count"] = \App\Models\Order::count();
    $viewData["products_count"] = \App\Models\Product::count();
    
    // Esto es para que el gráfico tenga datos que mostrar
    $viewData["latest_orders"] = \App\Models\Order::orderBy('id', 'desc')->take(15)->get();

    return view('admin.home.index')->with("viewData", $viewData);
}
}