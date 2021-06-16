    <form action="{{ route('estatisticas.estampaSort') }}">
        <div class="form-group">
            <label for="inputID">Id da Estampa</label>
            <input type="text" class="col-xs-2" name="id" id="inputId">
            <input type="submit" class="btn btn-primary btn-sm ml-2" value="Submeter">
        </div>
    </>
    @if ($stats['qtdTotal']==0)
        <table class="table mt-2">
            <tr>
                <td>
                    Esta estampa nunca foi vendida
                </td>
            </tr>
        </table>
    @else
        <table class="table mt-2">
            <tr>
                <td>
                    Quantidade de Estampas Vendidas:
                </td>
                <td>
                    {{$stats['qtdTotal']}}
                </td>
            </tr>
            <tr>
                <td>
                    Valor Total de Estampas Vendidas:
                </td>
                <td>
                    {{number_format($stats['valorTotal'],2)}} €
                </td>
            </tr>
            <tr>
                <td>
                    Maior Grupo de Estampas Vendidas:
                </td>
                <td>
                    {{$stats['qtdGrupo'].' ('.$stats['valorGrupo'].' €)'}}
                </td>
            </tr>

        </table>
    @endif
