@extends('layout')
@section('title', 'Dashboard')
@section('content')
    <div>Eu sou {{Auth::user()->name}} e sou do tipo {{Auth::user()->tipo}}</div>
@endsection
