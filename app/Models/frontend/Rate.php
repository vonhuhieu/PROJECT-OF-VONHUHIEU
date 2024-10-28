<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $table = 'rates';
    protected $fillable = ['id_blog', 'id_user', 'rate'];
    public $timestamps = true;

    public function blog()
    {
        return $this->belongsTo(\App\Models\admin\Blog::class, 'id_blog', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
