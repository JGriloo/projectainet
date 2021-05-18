@extends('layout')

@section('content')

    <h2>Clientes</h2>
    <div class="clientes-area">
        @foreach ($clientes as $cliente)
            <div class="cliente">
                <div class="cliente-imagem">
                    <img src="{{ $cliente->user->foto_url ? asset('storage/fotos/' . $cliente->user->foto_url) : asset('img/default_img.png') }}"
                        alt="Imagem do cliente">
                </div>
                <div class="cliente-info-area">
                    <div class="docente-name">{{ $cliente->user->name }}</div>
                    <div class="cliente-info">
                        <span class="cliente-label"><i class="fas fa-envelope"></i></span>
                        <span class="cliente-info-desc"><a
                                href="mailto:{{ $cliente->user->email }}">{{ $cliente->user->email }}</a>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
