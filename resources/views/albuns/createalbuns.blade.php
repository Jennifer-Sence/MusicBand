@extends('layouts.master')

@section('content')
    <h2>Criar Novo Álbum para {{ $band->name }}</h2>
    <form method="POST" action="{{ route('albuns.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="band_id" value="{{ $band->id }}">

        <div class="form-group">
            <label for="title">Nome do Álbum</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="release_date">Data de Lançamento</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>

        <div class="form-group">
            <label for="cover">Capa do Álbum</label>
            <input type="file" class="form-control-file" id="cover" name="cover">
        </div>

        <button type="submit" class="btn btn-primary">Criar Álbum</button>

    </form>
    <br>
@endsection
