<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_comment extends Model
{
    use HasFactory;
    protected $table = 'blog_comments';
    protected $fillable = ['id_blog', 'id_user', 'avatar', 'name', 'cmt', 'level'];
    public $timestamps = true;

    public function blog()
    {
        return $this->belongsTo(\App\Models\admin\Blog::class, 'id_blog', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id');
    }
}
