@extends('layout')
@section('title', 'Consultar Cliente')
@section('content')

    <form method="GET" action="{{ route('clientes.consult', ['cliente' => $cliente]) }}" class="form-group"
        enctype="multipart/form-data">
        @csrf
        @method('GET')
        <input type="hidden" name="id" value="{{ $cliente->id }}">
        <div class="form-group">
            <label for="inputNome">Nome</label>
            <p class="form-control" name="name">{{ $cliente->user->name }}</p>
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <p class="form-control" name="email">{{ $cliente->user->email }}</p>
            @error('email')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputNif">NIF</label>
            <p class="form-control" name="nif">{{ $cliente->nif }}</p>
            @error('nif')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEndereco">Endereço</label>
            <p class="form-control" name="endereco">{{ $cliente->endereco }}</p>
            @error('endereco')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        @isset($cliente->user->foto_url)
            <div class="form-group">
                <p>Foto:</p>
                <img src="{{ $cliente->user->foto_url ? asset('storage/fotos/' . $cliente->user->foto_url) : '' }}"
                    alt="Foto do cliente" class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            <a href="{{ route('clientes') }}" class="btn btn-secondary">Go Back</a>
        </div>
    </form>
@endsection
