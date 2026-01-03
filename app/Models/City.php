<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    
    protected $fillable = ['city_name'];
    
    public $timestamps = false;
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'city_id', 'city_id');
    }
}