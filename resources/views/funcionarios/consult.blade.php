@extends('layout')
@section('title', 'Consultar Funcionario')
@section('content')

    <form method="GET" action="{{ route('funcionarios.consult', ['funcionario' => $funcionario]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('GET')
        <input type="hidden" name="id" value="{{ $funcionario->id }}">
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <p class="form-control" name="name">{{ $funcionario->name }}</p>
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <p class="form-control" name="email">{{ $funcionario->email }}</p>
            @error('email')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        @isset($funcionario->foto_url)
            <div class="form-group">
                <p>Foto:</p>
                <img src="{{ $funcionario->foto_url ? asset('storage/fotos/' . $funcionario->foto_url) : '' }}"
                    alt="Foto do cliente" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            <a href="{{ route('funcionarios') }}" class="btn btn-secondary">Go Back</a>
        </div>
    </form>
@endsection
