<table class="table">
    <thead>
        <tr>
            <th>Filtro</th>

        </tr>
    </thead>
    <tbody>
            <tr>
                <form action="{{ route('estatisticas.sort') }}">
                    <td>
                        <select name="sort" id="sort">
                            <option value="data">Data</option>
                            <option value="cliente">Cliente</option>
                            <option value="estampas">Estampas</option>
                        </select>{{-- {{ $estatistica['name'] }} --}}
                    </td>
                    <td>
                        <div>
                            <input type="submit" class="btn btn-primary" value="Filtrar">
                        </div>
                    </td>
                </form>
            </tr>
    </tbody>
</table>
