<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const PENDIENTE = "0";
    const PAGADO = "1";
    const ENVIADO = "2";
    const ENTREGADO = "3";
    const ANULADO = "4";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
