<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favourite extends Model
{
    protected $table = 'favourites';
    protected $primaryKey = 'id_favourites';
    
    protected $fillable = ['user_id', 'pizza_id'];
    
    public $timestamps = false;
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }
    
    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class, 'pizza_id', 'pizza_id');
    }
}