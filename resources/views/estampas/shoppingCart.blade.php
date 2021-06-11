@extends('layout')
@section('title', 'Carrinho de Compras')
@section('content')
    @if (Session::has('cart'))
        <form method="post" action="{{ route('checkout') }}" class="form">
            @csrf
            <div class="form-group row">
                @foreach ($estampas as $estampa)
                    <li class="list-group-item">
                        <strong>{{ $estampa['quantidade'] }}x </strong>
                        <strong style="color:black">{{ $estampa['estampa']['nome'] }}</strong>
                        <span class="label label-success" style="color:orange"> 10€</span>
                        {{-- Escolher o tamanho da tshirt --}}
                        <div class="col-6">
                                <div class="input-group">
                                    <select class="custom-select" name="tshirt" id="inputTshirt" aria-label="Tshirt">
                                        <option value="">XS</option>
                                        <option value="">S</option>
                                        <option value="">M</option>
                                        <option value="">L</option>
                                        <option value="">XL</option>
                                    </select>
                                </div>
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
            <div>
                <input type="hidden" name="cliente_id" value="{{Auth::user()->id}}">
            </div>
            <div class="item-form">
                <label for="inputNome">NIF</label>
                <input type="text" class="form-control" name="nif" id="inputNif" value="{{ old('nif', $cliente->nif) }}">
                @error('nif')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="item-form">
                <label for="inputEmail">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="inputEndereco"
                    value="{{ old('endereco', $cliente->endereco) }}">
                @error('endereco')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="item-form">
                <div>Notas</div>
                <input type="text" class="form-control" name="notas" id="inputNotas" value="{{ old('notas') }}">
                @error('notas')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="item-form">
                <label for="inputEmail">Tipo Pagamento</label>
                <div class="col-md-6">
                        <input type="radio" name="tipo_pagamento" value="PayPal">
                        <label for="PayPal">PayPal</label><br>
                        <input type="radio" name="tipo_pagamento" value="VISA">
                        <label for="VISA">VISA</label><br>
                        <input type="radio" name="tipo_pagamento" value="MC">
                        <label for="MC">MC</label><br>
                </div>
                @error('tipo_pagamento')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputEmail">Referência de Pagamento</label>
                <input type="text" class="form-control" name="ref_pagamento" id="inputRefPagamento"
                    value="{{ old('ref_pagamento', $cliente->ref_pagamento) }}">
                @error('ref_pagamento')
                    <div class="small text-danger">{{ $message }}</div>
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
