@extends('layout')
@section('title', 'Editar Funcionário')
@section('content')
    <form method="POST" action="{{ route('funcionarios.update', ['funcionario' => $funcionario]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $funcionario->id }}">
        @include('funcionarios.partials.create-edit')
        @isset($funcionario->foto_url)
            <div class="form-group">
                <img src="{{ $funcionario->foto_url ? asset('storage/fotos/' . $funcionario->foto_url) : asset('img/default_img.png') }}"
                    alt="Foto do Funcionário" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($funcionario->foto_url)
                @can('update', $funcionario)
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                @endcan
            @endisset
            @can('update', $funcionario)
                <button type="submit" class="btn btn-success" name="ok">Save</button>
            @endcan
            <a href="{{ route('dashboard', ['funcionario' => $funcionario]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{ route('funcionarios.foto.destroy', ['funcionario' => $funcionario]) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
