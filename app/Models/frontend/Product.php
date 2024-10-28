<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id_user',
        'name',
        'price', 
        'id_category',
        'id_brand',
        'status',
        'sale',
        'company',
        'detail',
        'image'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\admin\Category::class, 'id_category', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\admin\Brand::class, 'id_brand', 'id');
    }

    public function product_rates()
    {
        return $this->hasMany(\App\Models\frontend\Product_rate::class, 'id_product', 'id');
    }

    public function product_reviews()
    {
        return $this->hasMany(\App\Models\frontend\Product_review::class, 'id_product', 'id')->orderBy('updated_at','desc');
    }

    public function product_review_replays()
    {
        return $this->hasMany(\App\Models\frontend\Product_review::class, 'id_product', 'id')->orderBy('updated_at', 'asc');
    }

    public function product_average()
    {
        return $this->hasOne(\App\Models\frontend\Product_average::class, 'id_product', 'id');
    }
}
