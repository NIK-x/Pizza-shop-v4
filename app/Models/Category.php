<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    
    protected $fillable = ['category_name', 'category_slug'];
    
    public $timestamps = false;
    
    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class, 'category_id', 'category_id');
    }
}