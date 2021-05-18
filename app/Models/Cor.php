<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nome'];

    public function tshirts()
    {
        return $this->belongsToMany(Tshirt::class, 'cores_tshirts', 'cores_id', 'tshirt_id');
    }
}