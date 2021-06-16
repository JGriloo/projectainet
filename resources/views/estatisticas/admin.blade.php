@extends('layout')
@section('title', 'Estatisticas')
@section('content')
    @include('estatisticas.partials.filter')
    @if (Route::current()->getName() == 'estatisticas.dataSort')
        @include('estatisticas.partials.data')
    @elseif (Route::current()->getName() == 'estatisticas.clienteSort')
        @include('estatisticas.partials.cliente')
    @elseif (Route::current()->getName() == 'estatisticas.estampaSort')
        @include('estatisticas.partials.estampa')
    @endif
@endsection
