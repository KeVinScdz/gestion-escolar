@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>
@php
    var_dump(json_decode($user));
@endphp
<form action="/logout" method="post">
    @csrf
    <button type="submit" class="btn">Cerrar sesión</button>
</form>
@endsection