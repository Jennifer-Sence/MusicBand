@extends('layouts.master')

@section('content')
<br>
<div class="container">
    <h2>Editar Banda</h2>

    @if (session('msg'))
    <p class="msg">{{ session('msg') }}</p>
@endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bands.editOrUpdate', $banda->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome da Banda</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $banda->name }}" required>
        </div>
       
        <div class="form-group">
            <label for="photo">Foto da Banda</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            @if ($banda->photo)
                <div>
                    <img class="img-bands" src="{{ asset('storage/' . $banda->photo) }}" alt="Foto da Banda">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
