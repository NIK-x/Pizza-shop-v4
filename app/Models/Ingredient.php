<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $table = 'ingredients';
    protected $primaryKey = 'id_ingredients';
    
    protected $fillable = [
        'ingredients_name', 
        'ingredients_price', 
        'ingredients_image'
    ];
    
    protected $casts = [
        'ingredients_price' => 'decimal:2',
    ];
    
    public $timestamps = false;
    
    public function pizzas(): BelongsToMany
    {
        return $this->belongsToMany(
            Pizza::class,
            'pizza_ingredients',
            'ingredient_id',
            'pizza_id',
            'id_ingredients',
            'pizza_id'
        )->withPivot('is_base');
    }
}