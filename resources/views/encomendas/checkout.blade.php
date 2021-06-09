@extends('layout')
@section('title', 'Checkout')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Checkout</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                @foreach ($clientes as $cliente)
                    <div class="form-group">
                        <label for="inputNif">NIF</label>
                        <input type="text" class="form-control" name="nif" id="inputNif"
                            value="{{ old('nif', $cliente->nif) }}">
                        @error('nif')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEndereco">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="inputEndereco"
                            value="{{ old('endereco', $cliente->endereco) }}">
                        @error('endereco')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
