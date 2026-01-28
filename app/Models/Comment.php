<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Esto es lo que permite que los datos se guarden en las columnas correspondientes
    protected $fillable = ['description', 'product_id', 'user_id'];

    public function user() { return $this->belongsTo(User::class); }
}