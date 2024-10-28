<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(\App\Models\frontend\Product::class, 'id_brand', 'id');
    }
}
