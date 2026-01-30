<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $viewData = [
            "title" => "Admin - Orders - Online Store",
            "subtitle" => "List of Orders",
            "orders" => Order::with(['user', 'items.product'])->orderBy('id', 'desc')->get(),
        ];

        return view('admin.order.index')->with("viewData", $viewData);
    }
}