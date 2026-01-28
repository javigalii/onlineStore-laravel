<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        // 1. Validar que el comentario no esté vacío
        $request->validate([
            'description' => 'required|min:5'
        ]);

        // 2. Guardar en la base de datos
        Comment::create([
            'description' => $request->input('description'),
            'product_id' => $productId,
            'user_id' => Auth::id(), // ID del usuario logueado
        ]);

        // 3. Volver a la página del producto con un mensaje de éxito
        return back()->with('success', '¡Comentario publicado!');
    }
}