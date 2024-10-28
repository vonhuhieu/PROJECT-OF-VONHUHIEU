<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class, 'id_country', 'id');
    }
}
