<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['cliente_id', 'preco_total', 'notas', 'nif', 'endereco', 'tipo_pagamento', 'ref_pagamento'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tshirts()
    {
        return $this->hasMany(Tshirt::class);
    }
}
