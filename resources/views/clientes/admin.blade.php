@extends('layout')
@section('title', 'Clientes')
@section('content')
    <div class="row mb-3">
        <div class="col-3">
            @can('create', App\Models\Cliente::class)
                <a href="{{ route('clientes.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo
                    Cliente</a>
            @endcan
        </div>
        <div class="col-9">
            <form method="GET" action="{{ route('clientes') }}" class="form-group">
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>NIF</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>
                        <img src="{{ $cliente->user->foto_url ? asset('storage/fotos/' . $cliente->user->foto_url) : asset('img/default_img.png') }}"
                            alt="Foto do cliente" class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{ $cliente->user->name }}</td>
                    <td>{{ $cliente->endereco }}</td>
                    <td>{{ $cliente->nif }}</td>
                    <td>
                        <div class="col text-center">
                        @can('viewAny', $cliente)
                            <a href="{{ route('clientes.consult', ['cliente' => $cliente]) }}" class="btn btn-primary btn-sm"
                                role="button" aria-pressed="true">Consultar</a>
                        @endcan
                        </div>
                    </td>
                    <td>
                        @can('bloquear', $cliente)
                        <div class="col text-center">
                            @if ($cliente->user->bloqueado==0)
                                <form action="{{ route('clientes.bloquear', ['cliente' => $cliente]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="bloqueado" value='1'>
                                    <input type="submit" class="btn btn-warning btn-sm" value="Bloquear">
                                </form>
                            @else
                                <form action="{{ route('clientes.bloquear', ['cliente' => $cliente]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="bloqueado" value='0'>
                                    <input type="submit" class="btn btn-success btn-sm" value="Desbloquear">
                                </form>
                            @endif
                        </div>
                        @endcan
                    </td>
                    <td>
                        @can('delete', $cliente)
                        <div class="col text-center">
                            <form action="{{ route('clientes.delete', ['cliente' => $cliente]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>
                        </div>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clientes->withQueryString()->links() }}
@endsection
