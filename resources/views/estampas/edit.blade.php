@extends('layout')
@section('title', 'Alterar Estampa')
@section('content')
    <form method="POST" action="{{ route('estampas.update', ['estampa' => $estampa]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $estampa->id }}">
        @include('estampas.partials.create-edit')
        @isset($estampa->imagem_url)
            <div class="form-group">
                <img src="{{ $estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/plain_white.png') }}"
                    alt="Foto da estampa" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($estampa->imagem_url)
                @can('update', $estampa)
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                @endcan
            @endisset
            @can('update', $estampa)
                <button type="submit" class="btn btn-success" name="ok">Save</button>
            @endcan
            <a href="{{ route('dashboard', ['estampa' => $estampa]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{ route('estampas.foto.destroy', ['estampa' => $estampa]) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
