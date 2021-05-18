<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nome'];

    public function estampas()
    {
        return $this->belongsToMany(Estampa::class, 'categorias_estampas', 'categoria_id', 'estampa_id');
    }
}