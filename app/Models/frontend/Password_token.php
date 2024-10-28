<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_token extends Model
{
    use HasFactory;
    protected $table = 'password_tokens';
    protected $fillable = [
        'id_user',
        'email',
        'token',
        'expire_at',
    ];
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
