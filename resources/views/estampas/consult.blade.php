@extends('layout')
@section('title', 'Consultar Estampa')
@section('content')

    <form method="GET" action="{{ route('estampas.consult', ['estampa' => $estampa]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('GET')
        <input type="hidden" name="id" value="{{ $estampa->id }}">
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <p class="form-control" name="nome">{{ $estampa->nome }}</p>
            @error('nome')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputDescricao">Descrição</label>
            <p class="form-control" name="descricao">{{ $estampa->descricao }}</p>
            @error('descricao')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputInfomarcaoExtra">Informação Extra</label>
            <p class="form-control" name="informacao_extra">{{ $estampa->informacao_extra }}</p>
            @error('informacao_extra')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        @isset($estampa->imagem_url)
            <div class="form-group">
                <p>Foto:</p>
                <img src="{{ $estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : '' }}"
                    alt="Foto da estampa" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            <a href="{{ route('estampas') }}" class="btn btn-secondary">Go Back</a>
        </div>
    </form>
@endsection
