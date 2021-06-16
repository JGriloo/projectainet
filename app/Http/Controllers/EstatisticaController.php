<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encomenda;
use App\Models\Tshirt;
use Illuminate\Support\Facades\View;

class EstatisticaController extends Controller
{

    public function admin(){
        return view('estatisticas.admin');
    }

    public function sort(Request $request){
        if($request->sort=='data'){
            return redirect()->route('estatisticas.dataSort');
        }elseif($request->sort=='cliente'){
            return redirect()->route('estatisticas.clienteSort');
        }elseif($request->sort=='estampas'){
            return redirect()->route('estatisticas.estampaSort');
        }
    }

    public function dataSort(Request $request){
        $data = Encomenda::orderBy('data', 'ASC')->first()->data;
        $minYear = substr($data,0,4);
        $maxYear = date('Y');
        $dates = array(
            'minYear' => $minYear,
            'maxYear' => $maxYear,
        );

        $month=$request->month ?? '01';
        $year=$request->year ?? '2018';

        $total = Encomenda::whereMonth('data','=',$month)
                        ->whereYear('data','=',$year)->sum('preco_total');
        $media = Encomenda::whereMonth('data','=',$month)
                        ->whereYear('data','=',$year)->avg('preco_total');

        $valoresDias = $this->infoDia($total,$month,$year);

        $stats=array(
            'total' => $total,
            'media' => $media,
            'diaMax' => $valoresDias['diaMax'],
            'diaMin' => $valoresDias['diaMin'],
            'max' => $valoresDias['max'],
            'min' => $valoresDias['min'],
            'zeros' => $valoresDias['zeros'],
        );
        return view('estatisticas.admin')
                ->withDates($dates)
                ->withStats($stats);
    }

    public function clienteSort(Request $request){
        //dd($request->id);
        //dd(Encomenda::where('cliente_id','=',22)->orderBy('preco_total','DESC')->first()->preco_total);
        $id = $request->id ?? '0';
        $total = Encomenda::where('cliente_id','=',$id)->sum('preco_total') ?? 0;
        $max = Encomenda::where('cliente_id','=',$id)->orderBy('preco_total','DESC')->first()->preco_total ?? 0;
        $min = Encomenda::where('cliente_id','=',$id)->orderBy('preco_total','ASC')->first()->preco_total ?? 0;
        $first = Encomenda::where('cliente_id','=',$id)->orderBy('data','ASC')->first()->data ?? 0;
        $latest = Encomenda::where('cliente_id','=',$id)->orderBy('data','DESC')->first()->data ?? 0;

        $stats = array(
            'total' => $total,
            'max' => $max,
            'min' => $min,
            'first' => $first,
            'latest' => $latest,
        );
        return view('estatisticas.admin')
            ->withStats($stats);
    }

    public function estampaSort(Request $request){
        $qtdTotal = Tshirt::where('estampa_id','=',$request->id)->sum('quantidade') ?? 0;
        $valorTotal = Tshirt::where('estampa_id','=',$request->id)->sum('subtotal') ?? 0;
        $qtdGrupo = Tshirt::where('estampa_id','=',$request->id)->orderBy('quantidade','DESC')->first()->quantidade ?? 0;
        $valorGrupo = Tshirt::where('estampa_id','=',$request->id)->orderBy('quantidade','DESC')->first()->subtotal ?? 0;
        $stats= array(
            'qtdTotal' => $qtdTotal,
            'valorTotal' => $valorTotal,
            'qtdGrupo' => $qtdGrupo,
            'valorGrupo' => $valorGrupo,
        );
        return view('estatisticas.admin')
            ->withStats($stats);
    }

    public function infoDia($total,$month,$year){
        $diaMax=0;
        $diaMin=0;
        $max=0;
        $min=$total;
        $zeros='';
        for($i=1;$i<=31;$i++){
            $aux = Encomenda::whereMonth('data','=',$month)
            ->whereYear('data','=',$year)
            ->whereDay('data','=',$i)->sum('preco_total');
            if($aux>=$max){
                $max=$aux;
                $diaMax=$i;
                continue;
            }
            if($aux<$min && $aux!=0){
                $min=$aux;
                $diaMin=$i;
                continue;
            }
            if($aux==0){
                $zeros=$zeros.$i.' | ';
            }
        }
        $zeros=substr($zeros,0,-2);
        $values=array(
            'diaMax' => $diaMax,
            'diaMin' => $diaMin,
            'max' => $max,
            'min' => $min,
            'zeros' => $zeros,
        );
        return $values;
    }
}
