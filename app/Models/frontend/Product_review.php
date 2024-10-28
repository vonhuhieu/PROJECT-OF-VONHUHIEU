<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';
    protected $fillable = [
        'id_product',
        'id_user',
        'avatar',
        'name',
        'review',
        'level'
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(\App\Models\frontend\Product::class, 'id_product', 'id');
    }

    public function users()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id');
    }
}
