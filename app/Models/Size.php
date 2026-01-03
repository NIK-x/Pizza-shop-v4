<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    protected $table = 'sizes';
    protected $primaryKey = 'id_sizes';
    
    protected $fillable = ['size_name', 'size_diameter'];
    
    public $timestamps = false;
    
    public function pizzas(): BelongsToMany
    {
        return $this->belongsToMany(
            Pizza::class,
            'pizza_sizes',
            'size_id',
            'pizza_id',
            'id_sizes',
            'pizza_id'
        )->withPivot('price');
    }
}