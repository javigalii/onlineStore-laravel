<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Order extends Model
{
    // ... Atributos comentados se mantienen igual ...

    public static function validate($request)
    {
        $request->validate([
            "total" => "required|numeric",
            "user_id" => "required|exists:users,id",
        ]);
    }
    
    // Esto asegura que Eloquent trate las fechas como objetos Carbon
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getTotal()
    {
        return $this->attributes['total'];
    }

    public function setTotal($total)
    {
        $this->attributes['total'] = $total;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($userId)
    {
        $this->attributes['user_id'] = $userId;
    }

    // CORRECCIÓN AQUÍ: Usar $this->created_at en lugar de $this->attributes
    public function getCreatedAt()
    {
        return $this->created_at; 
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    // CORRECCIÓN AQUÍ: Usar $this->updated_at en lugar de $this->attributes
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}