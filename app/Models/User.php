<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'id_country',
        'level',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\admin\Country::class, 'id_country', 'id');
    }

    public function rates()
    {
        return $this->hasMany(\App\Models\frontend\Rate::class, 'id_user', 'id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\frontend\Blog_comment::class, 'id_user', 'id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\frontend\Product::class, 'id_user', 'id');
    }

    public function product_rates()
    {
        return $this->hasMany(\App\Models\frontend\Product_rate::class, 'id_user', 'id');
    }

    public function product_reviews()
    {
        return $this->hasMany(\App\Models\frontend\Product_review::class, 'id_user', 'id');
    }

    public function histories()
    {
        return $this->hasMany(\App\Models\frontend\History::class, 'id_user', 'id');
    }

    public function token()
    {
        return $this->hasOne(\App\Models\frontend\Password_token::class, 'id_user', 'id');
    }

    public function user_opinions()
    {
        return $this->hasMany(\App\Models\frontend\User_opinion::class, 'id_user', 'id');
    }
}
