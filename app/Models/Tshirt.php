<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['tamanho', 'quantidade'];

    public function encomendaRef()
    {
        return $this->belongsTo(Encomenda::class, 'tshirt', 'tshirt_id');
    }

    public function estampaRef()
    {
        return $this->belongsTo(Estampa::class, 'tshirt', 'tshirt_id');
    }

    public function cores()
    {
        return $this->belongsTo(Cores::class, 'tshirts', 'tshirt_id');
    }
}