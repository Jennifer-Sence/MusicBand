@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 style="color: black">Olá, {{ Auth::user()->name }}!</h1>
</div>
@endsection
