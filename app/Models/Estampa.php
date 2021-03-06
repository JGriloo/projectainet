<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estampa extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nome, descricao, imagem_url'];


    public function tshirts()
    {
        return $this->hasMany(Tshirt::class, 'tshirt', 'tshirt_id');
    }

    public function clientes()
    {
        return $this->belongsToMany(Clientes::class, 'estampas_clientes', 'estampa_id', 'cliente_id');
    }

    public function categoriaRef()
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'categoria_id');
    }
}