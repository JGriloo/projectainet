<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{ old('nome', $estampa->nome) }}">
    @error('nome')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputDescricao">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao"
        value="{{ old('descricao', $estampa->descricao) }}">
    @error('descricao')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputInfomarcaoExtra">Informação Extra</label>
    <input type="text" class="form-control" name="informacao_extra" id="inputInfomarcaoExtra"
        value="{{ old('informacao_extra', $estampa->informacao_extra) }}">
    @error('informacao_extra')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control" name="imagem_url" id="inputFoto">
    @error('imagem_url')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
