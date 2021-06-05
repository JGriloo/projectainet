<div class="form-group">
    <label for="inputTipo">Tipo</label>
    <div>
            <input type="radio" name="tipo" value="A" {{ old('tipo', $funcionario->tipo) == 'A' ? 'checked' : '' }}>
            <label for="inputTipoA">Admin</label>
            <input type="radio" name="tipo" value="F" {{ old('tipo', $funcionario->tipo) == 'F' ? 'checked' : '' }}>
            <label for="inputTipoF">Funcionário</label>
    </div>
    @error('tipo')
        {{dd($funcionario)}}
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{ old('name', $funcionario->name) }}">
    @error('name')
        {{dd($funcionario)}}
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="text" class="form-control" name="email" id="inputEmail"
        value="{{ old('email', $funcionario->email) }}">
    @error('email')
        {{dd($funcionario)}}
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    @if(Route::current()->getName() == 'funcionarios.create')
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" name="password" id="inputPassword">
        @error('password')
            <div class="small text-danger">{{ $message }}</div>
        @enderror
    @endif
</div>

<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control" name="foto_url" id="inputFoto">
    @error('foto_url')
        {{dd($funcionario)}}
        <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
