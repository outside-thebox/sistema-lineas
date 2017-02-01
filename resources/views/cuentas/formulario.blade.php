@extends('layouts.app')
@section('content')
	
	<h1>@{{ titulo }}</h1>

	{!! Form::model(isset($cuenta) ? $cuenta:null ,[], ['role' => 'form']) !!}
		
		<div class="col-md-6">
			{{ Form::label('nro_cuenta','Nro de cuenta') }}
			{{ Form::text('nro_cuenta',null,['v-model' => 'nro_cuenta','placeholder' => 'Introduce el nro de cuenta', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('nombre_cuenta','Nombre de la cuenta') }}
			{{ Form::text('nombre_cuenta',null,['v-model' => 'nombre_cuenta','placeholder' => 'Introduce el nombre de la cuenta', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('dominio','Dominio') }}
			{{ Form::text('dominio',null,['v-model' => 'dominio','placeholder' => 'Introduce el dominio', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('server_principal','Nombre del server principal') }}
			{{ Form::text('server_principal',null,['v-model' => 'server_principal','placeholder' => 'Introduce nombre del server principal', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('server_backup','Nombre del server backup') }}
			{{ Form::text('server_backup',null,['v-model' => 'server_backup','placeholder' => 'Introduce nombre del server backup', 'class' => 'form-control']) }}
		</div>

		<div class="col-md-12">
			{!! Form::button("Guardar", ['type' => 'submit', 'class' => 'btn btn-primary pull-right']) !!}
	        <a href="{!! route('cuentas.index') !!}" class="btn btn-success pull-right" style="margin-right: 10px">Cancelar</a>
		</div>
	{!! Form::close() !!}
@endsection
@section('scripts')
	<script>
		new Vue({
			el: '#main',
			data:{
				titulo: 'Agregar una cuenta',
				nro_cuenta: '',
				nombre_cuenta: '',
				dominio: '',
				server_principal: '',
				server_backup: ''			
			}
		});
	</script>
@endsection
