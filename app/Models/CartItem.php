<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $table = 'cart_items';
    
    protected $fillable = [
        'user_id',
        'pizza_id', 
        'size_id',
        'quantity',
        'extra_ingredients',
        'total_price',
        'session_id'
    ];
    
    protected $casts = [
        'extra_ingredients' => 'array',
        'total_price' => 'decimal:2',
    ];
    
    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class, 'pizza_id', 'pizza_id');
    }
    
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id', 'id_sizes');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }
}