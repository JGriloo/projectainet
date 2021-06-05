@extends('layout')
@section('title', 'Funcionários')
@section('content')
    <div class="row mb-3">
            @can('create', App\Models\User::class)
                <a href="{{ route('funcionarios.create') }}" class="btn btn-success" role="button" aria-pressed="true">Novo
                    Funcionário</a>
            @endcan
        <div class="col-9">
            <form method="GET" action="{{ route('funcionarios') }}" class="form-group">
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Email</th>
                <th>Função</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>
                        <img src="{{ $funcionario->foto_url ? asset('storage/fotos/' . $funcionario->foto_url) : asset('img/default_img.png') }}"
                            alt="Foto do cliente" class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{ $funcionario->name }}</td>
                    <td>{{ $funcionario->email }}</td>
                    <td>
                        @if ($funcionario->tipo == 'A')
                            Administrador
                        @else
                            Funcionário
                        @endif
                    </td>
                    <td>
                        @can('viewAny', $funcionario)
                        <div class="col text-center">
                            <a href="{{ route('funcionarios.consult', ['funcionario' => $funcionario]) }}" class="btn btn-primary btn-sm"
                                role="button" aria-pressed="true">Consultar</a>
                        </div>
                        @endcan
                    </td>
                    <td>
                        @can('viewAny', $funcionario)
                        <div class="col text-center">
                            <a href="{{route('funcionarios.edit', ['funcionario' => $funcionario])}}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                        </div>
                        @endcan
                    </td>
                    <td>
                        <div class="col text-center">
                        @can('bloquear', $funcionario)
                            @if ($funcionario->bloqueado==0)
                                <form action="{{ route('funcionarios.bloquear', ['funcionario' => $funcionario]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="bloqueado" value='1'>
                                    <input type="submit" class="btn btn-warning btn-sm" value="Bloquear">
                                </form>
                            @else
                                <form action="{{ route('funcionarios.bloquear', ['funcionario' => $funcionario]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="bloqueado" value='0'>
                                    <input type="submit" class="btn btn-success btn-sm" value="Desbloquear">
                                </form>
                            @endif
                        @endcan
                        </div>
                    </td>
                    <td>
                        @can('delete', $funcionario)
                        <div class="col text-center">
                            <form action="{{ route('funcionarios.delete', ['funcionario' => $funcionario]) }}" method="POST">
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
    {{ $funcionarios->withQueryString()->links() }}
@endsection
