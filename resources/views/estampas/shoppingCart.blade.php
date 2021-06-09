@extends('layout')
@section('title', 'Carrinho de Compras')
@section('content')
    @if (Session::has('cart'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Checkout') }}</div>

                        <div class="card-body">
                                <div class="form-group row">
                                    @foreach ($estampas as $estampa)
                                        <li class="list-group-item">
                                            <strong>{{ $estampa['quantidade'] }}x </strong>
                                            <strong style="color:black">{{ $estampa['estampa']['nome'] }}</strong>
                                            <span class="label label-success" style="color:orange"> 10€</span>
                                            {{-- Escolher o tamanho da tshirt --}}
                                 <div class="col-6">
                                                <form method="GET" class="form-group">
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
                                    </ul>
                                </div>
                                <form method="POST" action="{{ route('checkout') }}" class="form-group"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="nif"
                                        class="col-md-4 col-form-label text-md-right">{{ __('NIF') }}</label>

                                    <div class="col-md-6">
                                        <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror"
                                            name="nif" value="{{ old('nif', $cliente->nif) }}" required autocomplete="nif"
                                            autofocus>

                                        @error('nif')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="endereco"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                                    <div class="col-md-6">
                                        <input id="endereco" type="text"
                                            class="form-control @error('endereco') is-invalid @enderror" name="endereco"
                                            value="{{ old('endereco', $cliente->endereco) }}" required
                                            autocomplete="endereco" autofocus>

                                        @error('endereco')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="notas"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Notas') }}</label>

                                    <div class="col-md-6">
                                        <input id="notas" type="text"
                                            class="form-control @error('notas') is-invalid @enderror" name="notas"
                                            value="{{ old('notas') }}" autocomplete="notas" autofocus>

                                        @error('notas')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="tipo_pagamento"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Tipo Pagamento') }}</label>

                                    <div class="col-md-6">
                                        <select>
                                            <option value=Paypal>Paypal</option>
                                            <option value=VISA>VISA</option>
                                            <option value=MasterCard>MasterCard</option>
                                        </select>
                                        @error('tipo_pagamento')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="ref_pagamento"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Referência Pagamento') }}</label>

                                    <div class="col-md-6">
                                        <input id="ref_pagamento" type="text"
                                            class="form-control @error('ref_pagamento') is-invalid @enderror"
                                            name="ref_pagamento"
                                            value="{{ old('ref_pagamento', $cliente->ref_pagamento) }}" required
                                            autocomplete="ref_pagamento" autofocus>

                                        @error('ref_pagamento')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Checkout') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>No items in cart </strong>
            </div>
        </div>
    @endif
@endsection
