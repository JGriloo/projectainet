<form action="{{ route('estatisticas.clienteSort') }}">
    <div class="form-group">
        <label for="inputID">Id do Cliente</label>
        <input type="text" class="col-xs-2" name="id" id="inputId">
        <input type="submit" class="btn btn-primary btn-sm ml-2" value="Submeter">
    </div>
</form>
@if ($stats['total']==0)
    <table class="table mt-2">
        <tr>
            <td>
                Este cliente não fez nenhuma compra
            </td>
        </tr>
    </table>
@else
    <table class="table mt-2">
        <tr>
            <td>
                Valor Total de Compras:
            </td>
            <td>
                {{number_format($stats['total'],2)}} €
            </td>
        </tr>
        <tr>
            <td>
                Compra mais Cara:
            </td>
            <td>
                {{number_format($stats['max'],2)}} €
            </td>
        </tr>
        <tr>
            <td>
                Compra mais Barata:
            </td>
            <td>
                {{number_format($stats['min'],2)}} €
            </td>
        </tr>
        <tr>
            <td>
                Data da Primeira Compra:
            </td>
            <td>
                {{$stats['first']}}
            </td>
        </tr>
        <tr>
            <td>
                Data da Compra mais Recente:
            </td>
            <td>
                {{$stats['latest']}}
            </td>
        </tr>
    </table>
@endif
