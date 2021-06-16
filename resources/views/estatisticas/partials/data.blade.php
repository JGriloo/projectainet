<form action="{{ route('estatisticas.dataSort') }}">
    <label for="month">Mês:</label>
    <select name="month" id="month">
            @for($i=1;$i<=12;$i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
    </select>
    <label for="year">Ano:</label>
    <select name="year" id="year">
        @for($i=$dates['minYear'];$i<=$dates['maxYear'];$i++)
            <option value="{{$i}}">{{$i}}</option>
        @endfor
    </select>
    <input type="submit" class="btn btn-primary btn-sm ml-2" value="Submeter">
</form>
    @if ($stats['total']==0)
        <table class="table mt-2">
            <tr>
                <td>
                    Não foi vendido nenhum produto neste mês
                </td>
            </tr>
        </table>
    @else
        <table class="table mt-2">
            <tr>
                <td>
                    Valor Total de Vendas:
                </td>
                <td>
                    {{number_format($stats['total'],2)}} €
                </td>
            </tr>
            <tr>
                <td>
                    Média de Valor de Vendas:
                </td>
                <td>
                    {{number_format($stats['media'],2)}} €
                </td>
            </tr>
            <tr>
                <td>
                    Dia Com Maior Valor de Vendas:
                </td>
                <td>
                    {{$stats['diaMax']}} ({{$stats['max']}} €)
                </td>
            </tr>
            <tr>
                <td>
                    Dia Com Menor Valor de Vendas (Mais do que 0):
                </td>
                <td>
                    {{$stats['diaMin']}} ({{$stats['min']}} €)
                </td>
            </tr>
            <tr>
                <td>
                    Dias Sem Vendas:
                </td>
                <td>
                    {{$stats['zeros']}}
                </td>
            </tr>
        </table>
    @endif
