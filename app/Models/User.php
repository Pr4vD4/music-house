<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\Facades\Cart;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Полное имя пользователя
    public function getFullNameAttribute()
    {
        return trim("{$this->surname} {$this->name} {$this->patronymic}");
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Получить активную корзину пользователя
     */
    public function cart()
    {
        return Cart::session($this->id);
    }

    /**
     * Очистить корзину пользователя
     */
    public function clearCart()
    {
        return $this->cart()->clear();
    }

    /**
     * Получить содержимое корзины
     */
    public function getCartContent()
    {
        return $this->cart()->getContent();
    }

    /**
     * Получить общую сумму корзины
     */
    public function getCartTotal()
    {
        return $this->cart()->getTotal();
    }
}
