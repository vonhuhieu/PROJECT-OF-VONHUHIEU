<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = ['title', 'image', 'content'];
    public $timestamps = true;

    public function rates()
    {
        return $this->hasMany(\App\Models\frontend\Rate::class, 'id_blog', 'id');
    }

    public function comments_desc()
    {
        return $this->hasMany(\App\Models\frontend\Blog_comment::class, 'id_blog', 'id')->orderBy('updated_at', 'desc');
    }

    public function comments_asc()
    {
        return $this->hasMany(\App\Models\frontend\Blog_comment::class, 'id_blog', 'id')->orderBy('updated_at', 'asc');
    }
}
