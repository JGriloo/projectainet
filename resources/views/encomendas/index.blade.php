@extends('layout')
@section('title', 'Encomendas')
@section('content')
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
            </div>
            <div class="row">
                <main class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nº Enc.</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Total</th>
                                <th scope="col">NIF</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Tipo Pagamento</th>
                                <th scope="col">Referência de Pagamento</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($encomendas as $encomenda)
                                <tr>
                                    <th scope="row">{{ $encomenda->id }}</th>
                                    @if ($encomenda->estado == 'anulada')
                                        <td><span class="badge badge-danger">{{ strtoupper($encomenda->estado) }}</span>
                                        </td>

                                    @endif
                                    @if ($encomenda->estado == 'fechada')
                                        <td><span class="badge badge-success">{{ strtoupper($encomenda->estado) }}</span>
                                        </td>

                                    @endif
                                    @if ($encomenda->estado == 'paga')
                                        <td><span class="badge badge-primary">{{ strtoupper($encomenda->estado) }}</span>
                                        </td>

                                    @endif
                                    @if ($encomenda->estado == 'pendente')
                                        <td><span class="badge badge-warning">{{ strtoupper($encomenda->estado) }}</span>
                                        </td>

                                    @endif
                                    <td>{{ config('settings.currency_symbol') }}{{ $encomenda->preco_total }}
                                    <td>{{ $encomenda->nif }}
                                    <td>{{ $encomenda->endereco }}
                                    <td>{{ $encomenda->tipo_pagamento }}
                                    <td>{{ $encomenda->ref_pagamento }}
                                        {{-- <td><button><i class="fa fa-plus" aria-hidden="true"></i></button> --}}
                                    </td>
                                    <td>
                                        @if (Auth::user()->tipo == 'F' || Auth::user()->tipo == 'A')
                                            @if ($encomenda->estado == 'pendente')
                                                <form action="{{ route('encomenda.paga', ['encomenda' => $encomenda]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="submit" class="btn-sm btn-info" value="Paga">
                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('encomenda.fechada', ['encomenda' => $encomenda]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="submit" class="btn-sm btn-success" value="Fechada">
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if (Auth::user()->tipo == 'A')
                                            @if ($encomenda->estado != 'anulada')
                                                <form
                                                    action="{{ route('encomenda.anulada', ['encomenda' => $encomenda]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="submit" class="btn-sm btn-danger" value="Anular">
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <div class="col-sm-12">
                                    <p class="alert alert-warning">No orders to display.</p>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    </section>
    {{ $encomendas->withQueryString()->links() }}
@endsection
