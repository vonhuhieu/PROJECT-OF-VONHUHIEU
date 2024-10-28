<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'level'];
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(\App\Models\frontend\Product::class, 'id_category', 'id');
    }
}
