<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['notas', 'tipo_pagamento'];

    public function clientes()
    {
        return $this->belongsToOne(Cliente::class, 'encomendas_cliente', 'encomenda_id', 'cliente_id');
    }

    public function tshirts()
    {
        return $this->belongsToMany(Tshirt::class, 'encomendas_tshirts', 'encomenda_id', 'tshirt_id');
    }
}