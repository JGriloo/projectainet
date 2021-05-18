@extends('layout')
@section('title', 'Novo Cliente')
@section('content')
    <form method="POST" action="{{ route('clientes.store') }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('clientes.partials.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{ route('clientes.create') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
