@extends('layouts.app')

@section('content')
	<h1>Listado de cuentas</h1>

	<a href="{{ route('cuentas.create') }}" class="btn btn-primary">Agregar</a>
@endsection

