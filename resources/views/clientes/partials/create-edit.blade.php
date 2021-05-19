<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{ old('name', $cliente->user->name) }}">
    @error('name')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="text" class="form-control" name="email" id="inputEmail"
        value="{{ old('email', $cliente->user->email) }}">
    @error('email')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputNif">NIF</label>
    <input type="text" class="form-control" name="nif" id="inputNif" value="{{ old('nif', $cliente->nif) }}">
    @error('nif')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEndereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="inputEndereco"
        value="{{ old('endereco', $cliente->endereco) }}">
    @error('endereco')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control" name="foto_url" id="inputFoto">
    @error('foto_url')
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
