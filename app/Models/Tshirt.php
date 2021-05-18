<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['tamanho', 'quantidade'];

    public function encomenda()
    {
        return $this->belongsToOne(Encomenda::class, 'tshirts_encomenda', 'thisrt_id', 'encomenda_id');
    }

    public function estampas()
    {
        return $this->belongsToOne(Estampa::class, 'tshirts_estampas', 'thisrt_id', 'estampa_id');
    }

    public function cores()
    {
        return $this->belongsToMany(Cores::class, 'tshirts_cores', 'thisrt_id', 'cor_id');
    }
}