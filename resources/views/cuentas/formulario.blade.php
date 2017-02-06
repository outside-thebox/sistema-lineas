@extends('layouts.app')
@section('content')
	
	<h1>@{{ titulo }}</h1>

	{!! Form::model(isset($cuenta) ? $cuenta:null ,[''], ['role' => 'form']) !!}

		<input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

		<div class="col-md-6">
			{{ Form::label('nro_cuenta','Nro de cuenta') }}
			{{ Form::text('nro_cuenta',null,['v-model' => 'cuenta.nro_cuenta','placeholder' => 'Introduce el nro de cuenta', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('nombre_cuenta','Nombre de la cuenta') }}
			{{ Form::text('nombre_cuenta',null,['v-model' => 'cuenta.nombre_cuenta','placeholder' => 'Introduce el nombre de la cuenta', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('dominio','Dominio') }}
			{{ Form::text('dominio',null,['v-model' => 'cuenta.dominio','placeholder' => 'Introduce el dominio', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('nombre_server_principal','Nombre del server principal') }}
			{{ Form::text('nombre_server_principal',null,['v-model' => 'cuenta.nombre_server_principal','placeholder' => 'Introduce nombre del server principal', 'class' => 'form-control']) }}
		</div>
		<div class="col-md-6">
			{{ Form::label('nombre_server_backup','Nombre del server backup') }}
			{{ Form::text('nombre_server_backup',null,['v-model' => 'cuenta.nombre_server_backup','placeholder' => 'Introduce nombre del server backup', 'class' => 'form-control']) }}
		</div>

		<div class="col-md-12">
			{!! Form::button("Guardar", ['type' => 'submit', 'class' => 'btn btn-primary pull-right', '@click.prevent'=>"createCuenta()"]) !!}
	        <a href="{!! route('cuentas.index') !!}" class="btn btn-success pull-right" style="margin-right: 10px">Cancelar</a>
		</div>

	{!! Form::close() !!}
	<pre> @{{ $data | json }} </pre>
@endsection
@section('scripts')
	<script>
		vm = new Vue({
			el: '#main',
			data:{
				cuenta : {
					titulo: 'Agregar una cuenta',
					nro_cuenta: '',
					nombre_cuenta: '',
					dominio: '',
					nombre_server_principal: '',
					nombre_server_backup: ''
				},
				errors: [],
				token: ''

			},
			methods:{
				createCuenta: function(){
					this.errors = [];
					var cuenta = JSON.stringify(this.cuenta);
					$.ajax({
						url: "{{ Route('cuentas.store') }}",
						method: 'POST',
						data: "cuenta="+cuenta+"&_token="+this.token,
						dataType: 'json',
						success: function (data) {
							console.log("hola");
						},
						error: function (jqXHR) {
							//vm.errors = jqXHR.responseJSON.errors;
							console.log(jqXHR);
						}
					});
				}
			}
		});
	</script>
@endsection
