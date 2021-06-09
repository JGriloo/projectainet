<?php

namespace App\Models;

class Cart
{

    public $estampas = null;
    public $totalQuantidade = 0;
    public $totalPreco = 0;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->estampas = $oldCart->estampas;
            $this->totalQuantidade = $oldCart->totalQuantidade;
            $this->totalPreco = $oldCart->totalPreco;
        }
    }

    public function add($estampa, $id){
        $storedItem = ['quantidade' => 0, 'preco' => 10, 'estampa' => $estampa];
        if($this->estampas){
            if(array_key_exists($id, $this->estampas)){
                $storedItem = $this->estampas[$id];
            }
        }
        $storedItem['quantidade']++;
        $storedItem['preco'] = 10 * $storedItem['quantidade'];
        $this->estampas[$id] = $storedItem;
        $this->totalQuantidade++;
        $this->totalPreco += 10;
    }
}