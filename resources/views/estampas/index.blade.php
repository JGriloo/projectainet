@extends('layout')
@section('title', 'Estampas')
@section('content')
    <div class="row mb-3">
        <div class="col-3">
            @can('doAny', App\Models\Estampa::class)
                <a href="{{ route('estampas.create') }}" class="btn btn-success" role="button" aria-pressed="true">Nova
                    Estampa</a>
            @endcan
        </div>
        <div class="col-9">
            <form method="GET" action="{{ route('estampas') }}" class="form-group">
                <div class="input-group">
                    <select class="custom-select" name="categoria" id="inputCategoria" aria-label="Categoria">
                        <option value="" {{ '' == old('categoria', $selectedCategoria) ? 'selected' : '' }}>Todas
                            Categorias</option>
                        @foreach ($categorias as $abr => $nome)
                            <option value={{ $abr }}
                                {{ $abr == old('categoria', $selectedCategoria) ? 'selected' : '' }}>
                                {{ $nome }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Descrição</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estampas as $estampa)
                <tr>
                    <td>
                        <img src="{{ $estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/plain_white.png') }}"
                            alt="Foto da eatampa" class="img-profile rounded-circle" style="width:40px;height:40px">
                    </td>
                    <td>{{ $estampa->nome }}</td>
                    <td>{{ $estampa->descricao }}</td>
                    <td>
                        <a href="{{ route('estampas.consult', ['estampa' => $estampa]) }}" class="btn btn-primary btn-sm"
                            role="button" aria-pressed="true">Consultar</a>
                    </td>
                    <td>
                        <a href="{{ route('estampas.addToCart', ['id' => $estampa->id]) }}"
                            class="btn btn-success btn-sm" role="button" aria-pressed="true">Comprar</a>
                    </td>
                    <td>
                        @can('doAny', $estampa)
                            <a href="{{ route('estampas.edit', ['estampa' => $estampa]) }}" class="btn btn-primary btn-sm"
                                role="button" aria-pressed="true">Editar</a>
                        @endcan
                    </td>
                    <td>
                        @can('doAny', $estampa)
                            <form action="{{ route('estampas.delete', ['estampa' => $estampa]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $estampas->withQueryString()->links() }}
@endsection
