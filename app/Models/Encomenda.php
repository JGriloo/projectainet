<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['estado', 'cliente_id', 'preco_total', 'data','notas', 'nif', 'endereco', 'tipo_pagamento', 'ref_pagamento'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'encomenda_id', 'cliente_id');
    }

    public function tshirts()
    {
        return $this->hasMany(Tshirt::class);
    }
}