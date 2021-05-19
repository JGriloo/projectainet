<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = ['id', 'nif', 'endereco', 'created_at'];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function encomendas()
    {
        return $this->belongsToMany(Encomenda::class, 'clientes_encomendas', 'cliente_id', 'encomenda_id');
    }
    public function estampas()
    {
        return $this->belongsToMany(Estampa::class, 'clientes_estampas', 'cliente_id', 'estampa_id');
    }
}