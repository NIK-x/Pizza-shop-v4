<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_users';
    
    protected $fillable = [
        'name_user',
        'email_user', 
        'password_user',
        'phone_user',
        'city_id'
    ];

    protected $hidden = [
        'password_user',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getAuthIdentifierName()
    {
        return 'id_users';
    }

    public function getAuthIdentifier()
    {
        return $this->id_users;
    }

    public function getAuthPassword()
    {
        return $this->password_user;
    }

    public function getEmailForPasswordReset()
    {
        return $this->email_user;
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function favourites(): HasMany
    {
        return $this->hasMany(Favourite::class, 'user_id', 'id_users');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'user_id', 'id_users');
    }
}