<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_opinion extends Model
{
    use HasFactory;
    protected $table = 'user_opinions';
    protected $fillable = [
        'id_user',
        'name',
        'email',
        'subject',
        'opinion',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
