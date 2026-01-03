<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pizza extends Model
{
    protected $table = 'pizzas';
    protected $primaryKey = 'pizza_id';
    
    protected $fillable = [
        'pizza_name',
        'pizza_description', 
        'pizza_price',
        'pizza_image',
        'pizza_popular',
        'category_id'
    ];
    
    protected $casts = [
        'pizza_price' => 'decimal:2',
        'pizza_popular' => 'boolean',
    ];
    
    public $timestamps = false;
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(
            Size::class,
            'pizza_sizes',
            'pizza_id',
            'size_id',
            'pizza_id',
            'id_sizes'
        )->withPivot('price');
    }
    
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(
            Ingredient::class,
            'pizza_ingredients',
            'pizza_id',
            'ingredient_id',
            'pizza_id',
            'id_ingredients'
        )->withPivot('is_base');
    }
    
    public function baseIngredients()
    {
        return $this->ingredients()->wherePivot('is_base', 1);
    }
    
    public function extraIngredients()
    {
        return $this->ingredients()->wherePivot('is_base', 0);
    }
    
    public function scopePopular($query)
    {
        return $query->where('pizza_popular', 1);
    }
    
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function($q) use ($categorySlug) {
            $q->where('category_slug', $categorySlug);
        });
    }
}