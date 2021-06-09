<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cores extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nome'];

    public function tshirtRef()
    {
        return $this->hasMany(Tshirt::class, 'tshirt', 'tshirt_id');
    }
}