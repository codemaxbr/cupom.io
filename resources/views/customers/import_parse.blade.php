<p class="info-import">
    <h3>Agora você precisa definir as colunas da sua planilha.</h3>
    Selecione a opção correta para cada coluna.
</p>

<div class="parse_import">
    <form id="parseImport" method="post" action="{{ route('customers.import.submit') }}">
        {{ csrf_field() }}
        <input type="hidden" name="url_arquivo" value="{{ $csv_file }}" style="display: none;">
        <table class="table ls-table" id="tabela_faturas">
            <thead>
            <tr>
                <th class="col-md-3">Coluna Arquivo</th>
                <th class="col-md-4">Mapeamento</th>
                <th class="col-md-5">Exemplo da Linha</th>
            </tr>
            </thead>
            <tbody>

                @if( isset($csv_header))
                    @for($i = 0; $i < count($csv_header); $i++)
                    <tr>
                        <td class="col-md-3">
                            {{ $csv_header[$i] }}
                        </td>
                        <td class="col-md-4">
                            <select name="map[]" class="form-control">
                                <option value="">(Nenhum)</option>
                                @foreach($fields_db as $field => $description)
                                    <option value="{{ $field }}">{{ $description }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="col-md-5">
                            <span class="label">{{ $csv_rows[$i] }}</span>
                        </td>
                    </tr>
                    @endfor
                @endif

            </tbody>
        </table>

        <div class="buttons">
            <button type="submit" class="btn btn-primary">
                Iniciar Importação
            </button>
        </div>
    </form>
</div>