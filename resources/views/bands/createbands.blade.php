@extends('layouts.master')

@section('content')
<br>
<h2>Adicionar Nova Banda</h2>
<br>

@if (session('msg'))
<p class="msg">{{ session ('msg') }}</p>
@endif

<form method="POST" action="{{ route('bands.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">Nome da Banda</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="photo">Foto da Banda</label>
        <input type="file" accept="image/*" name="photo" class="form-control" id="photo">
        @error('photo')
            photo
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Criar Nova Banda</button>

</form>

<br>
@endsection
