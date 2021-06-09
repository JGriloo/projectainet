@extends('layout')
@section('title', 'Carrinho de Compras')
@section('content')
@if (Session::has('cart'))
    <form method="post" action="{{ route('checkout') }}" class="form" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="form-group row">
            @foreach ($estampas as $estampa)
                <li class="list-group-item">
                    <strong>{{ $estampa['quantidade'] }}x </strong>
                    <strong style="color:black">{{ $estampa['estampa']['nome'] }}</strong>
                    <span class="label label-success" style="color:orange"> 10€</span>
                    {{-- Escolher o tamanho da tshirt --}}
                    <div class="col-6">
                        <form class="form-group">
                            <div class="input-group">
                                <select class="custom-select" name="tshirt" id="inputTshirt"
                                    aria-label="Tshirt">
                                    <option value="">XS</option>
                                    <option value="">S</option>
                                    <option value="">M</option>
                                    <option value="">L</option>
                                    <option value="">XL</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    {{-- Escolher a cor da tshirt --}}
                    <div class="input-group">
                        <select class="custom-select" name="cor" id="inputCor" aria-label="Cor">
                            @foreach ($cores as $cor => $nome)
                                <option value={{ $cor }}
                                    {{ $cor == old('cor', $selectedCor) ? 'selected' : '' }}>
                                    {{ $nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>
            @endforeach
        </div>
        <div class="form-group">
            <label for="inputNome">NIF</label>
            <input type="text" class="form-control" name="nif" id="inputNif" value="{{old('nif', $cliente->nif)}}" >
            @error('nif')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Endereço</label>
            <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', $cliente->endereco)}}" >
            @error('endereco')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <div>Notas</div>
            <input type="text" class="form-control" name="notas" id="inputNotas" value="{{old('notas')}}" >
            @error('notas')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Tipo Pagamento</label>
            <div class="col-md-6">
                <select>
                    <option value=Paypal>Paypal</option>
                    <option value=VISA>VISA</option>
                    <option value=MasterCard>MasterCard</option>
                </select>
            </div>
            @error('tipo_pagamento')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail">Referência de Pagamento</label>
            <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento" value="{{old('ref_pagamento', $cliente->ref_pagamento)}}" >
            @error('ref_pagamento')
                <div class="small text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Buy</button>
            <a href="{{ route('estampas') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    @else
    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <strong>No items in cart </strong>
        </div>
    </div>
    @endif
@endsection