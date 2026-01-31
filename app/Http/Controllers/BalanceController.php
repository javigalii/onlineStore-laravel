<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    // Mostrar la vista de recarga
    public function index()
    {
        $viewData = [
            "title" => "Mi Cartera - Tech Store",
            "subtitle" => "Gestionar mi Saldo",
            "balance" => Auth::user()->getBalance()
        ];
        return view('balance.index')->with("viewData", $viewData);
    }

    // Procesar la recarga
    public function add(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:99999999'
        ]);

        $user = Auth::user();
        $newBalance = $user->getBalance() + $request->input('amount');
        
        $user->setBalance($newBalance);
        $user->save();

        return back()->with('success', '¡Saldo recargado correctamente!');
    }
}