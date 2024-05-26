@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="container">
            <h2>Álbuns de {{ $band->name }}</h2>
            @if (session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome do Álbum</th>
                        <th scope="col">Capa</th>
                        <th scope="col">Data de Lançamento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($albums as $album)
                        <tr>
                            <td>{{ $album->title }}</td>
                            <td>
                                <img class="img-bands"
                                    src="{{ $album->cover_url ? asset('storage/' . $album->cover_url) : asset('img/nophoto.jpg') }}"
                                    alt="Capa do Álbum">
                            </td>
                            <td>{{ $album->release_date }}</td>
                            <td>
                                @if (Auth::check())
                                    <a href="{{ route('albuns.editOrUpdate', $album->id) }}"
                                        class="btn btn-warning btn-sm">Editar Álbum</a>
                                @endif
                                @if (Auth::check() && Auth::user()->role == 'admin')
                                    <a href="{{ route('albuns.delete', $album->id) }}" class="btn btn-danger btn-sm">Apagar
                                        Álbum</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <tr>
                            <td colspan="4" class="text-right">
                                <a href="{{ route('albuns.create', $band->id) }}" class="btn btn-success btn-sm">Inserir
                                    Álbum</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
