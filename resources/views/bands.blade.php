@extends('layouts.master')

@section('content')
    <br>
    <div class="container">
        <h2>Tabela de Bandas</h2>

        @if (session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome da Banda</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Número de Álbuns Criados</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bandas as $banda)
                    <tr>
                        <td>{{ $banda->name }}</td>
                        <td>
                            <img class="img-bands"
                                src="{{ $banda->photo ? asset('storage/' . $banda->photo) : asset('img/nophoto.jpg') }}">
                        </td>
                        <td>{{$banda->albums_count}}</td>
                        <td>
                            <a href="{{ route('albuns.show', $banda->id) }}" class="btn btn-primary btn-sm">Ver Álbuns</a>
                            <br>


                            @if (Auth::check())
                                <a href="{{ route('bands.editOrUpdate', $banda->id) }}"
                                    class="btn btn-warning btn-sm">Editar Banda</a>
                                <br>
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('bands.delete', $banda->id) }}" class="btn btn-danger btn-sm">Apagar
                                        Banda</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            @if (Auth::check() && Auth::user()->role == 'admin')
                <a href="{{ route('bands.create') }}" class="btn btn-success btn-sm">Inserir Banda</a>
            @endif
            <br>
        </div>
    </div>
@endsection
