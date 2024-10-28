<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_rate extends Model
{
    use HasFactory;
    protected $table = 'product_rates';
    protected $fillable = [
        'id_product',
        'id_user',
        'rate',
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(\App\Models\frontend\Product::class, 'id_product', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id');
    }
}
