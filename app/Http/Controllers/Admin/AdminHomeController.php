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
        $viewData["title"] = "Admin Page - Admin - Online Store";
        $viewData["orders"] = Order::with(['user', 'items.product'])->get();
        return view('admin.home.index')->with("viewData", $viewData);
    }
}