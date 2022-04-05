<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'coste_envio'];

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
