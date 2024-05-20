@extends('layouts.master')

@section('content')
    <br>
    <h2>Editar Álbum</h2>
    <br>

    @if (session('msg'))
        <p class="msg">{{ session('msg') }}</p>
    @endif

    <form method="POST" action="{{ route('albuns.editOrUpdate', $album->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Nome do Álbum</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $album->title }}" required>
        </div>

        <div hidden class="form-group">
            <label for="band_id">ID da Banda</label>
            <input type="number" class="form-control" id="band_id" name="band_id" value="{{ $album->band_id }}" required>
        </div>

        <div class="form-group">
            <label for="release_date">Data de Lançamento</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>

        <div class="form-group">
            <label for="cover_url">Capa do Álbum</label>
            <input type="file" class="form-control-file" id="cover_url" name="cover_url">
            @if ($album->cover_url)
                <img src="{{ asset('storage/' . $album->cover_url) }}" alt="Capa do Álbum" class="img-thumbnail"
                    width="150" >
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Álbum</button>
    </form>

    <br>
@endsection


