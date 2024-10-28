<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_average extends Model
{
    use HasFactory;
    protected $table = 'product_averages';
    protected $fillable = [
        'id_product',
        'count_rate',
        'average',
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(\App\Models\frontend\Product::class, 'id_product', 'id');
    }
}
