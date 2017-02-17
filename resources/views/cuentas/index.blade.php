@extends('layouts.app')

@section('scripts')

<script>

    function filtrar() {
        var params = "";

        if($('input:text[name=nro_cuenta]').val() != "")
            params += "&like[nro_cuenta]="+ $('input:text[name=nro_cuenta]').val();
        if($('input:text[name=nombre_cuenta]').val() != "")
            params += "&like[nombre_cuenta]="+ $('input:text[name=nombre_cuenta]').val();
        if($('input:text[name=dominio]').val() != "")
            params += "&like[dominio]="+ $('input:text[name=dominio]').val();

        return params;
    }

    vm = new Vue({
        el: '#main',
        data:{
            cuenta : {
                nro_cuenta: '',
                nombre_cuenta: '',
                dominio: ''
            },
            pagina_actual: 0,
            lista: [],
            busqueda: true,
            token: ''

        },
        methods:{
            buscar: function(){
                var filtro = filtrar();
                var url = "{{route('api.v1.cuentas.index')}}" + "?" + "page=1";
                var queryString = url + "&methodFilter=filterWithPaginate&" + filtro;


                var cuenta = JSON.stringify(this.cuenta);
                cargando('sk-circle','Buscando');
                $.ajax({
                    url: queryString,
                    method: 'GET',
                    dataType: 'json',
                    assync: true,
                    success: function (data) {
                        vm.pagina_actual = data.data.current_page;
                        vm.lista = data.data.data;
                        HoldOn.close();
                    },
                    error: function (respuesta) {

                        HoldOn.close();
                    }
                });
                vm.busqueda = false;
//                console.log(filtrar());

            }
        }
    });


</script>

@endsection

@section('content')
	<h1>
        Listado de cuentas
        <a href="{{ route('cuentas.create') }}" class="btn btn-primary pull-right">Agregar</a>
    </h1>

    <div class="form-inline">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" v-model="token">

        {{ method_field('PUT') }}

        {{ Form::text('nro_cuenta',null,['class' => 'form-control','placeholder' => 'Nro de cuenta','v-model' => 'cuenta.nro_cuenta']) }}

        {{ Form::text('nombre_cuenta',null,['class' => 'form-control','placeholder' => 'Nombre de la cuenta','v-model' => 'cuenta.nombre_cuenta']) }}

        {{ Form::text('dominio',null,['class' => 'form-control','placeholder' => 'Dominio','v-model' => 'cuenta.dominio']) }}

        {{ Form::button('buscar',['class' => 'btn btn-success', '@click.prevent'=>'buscar()']) }}

    </div>

    <div v-show="lista.length > 0">
<!--        {{ Form::button('Primera',['id' => 'first','class' => 'btn btn-success','data-url'=>'']) }}-->
<!--        {{ Form::button('Anterior',['id' => 'prev','class' => 'btn btn-success','data-url'=>'']) }}-->
<!--        {{ Form::button('Última',['id' => 'last','class' => 'btn btn-success pull-right','data-url'=>'']) }}-->
<!--        {{ Form::button('Siguiente',['id' => 'next','class' => 'btn btn-success pull-right','data-url'=>'']) }}-->
        <table class="table responsive table-bordered table-hover table-striped" >
            <thead>
            <tr>
                <th>Nro de cuenta</th>
                <th>Nombre</th>
                <th>Dominio</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="table">
                <tr v-for="registro in lista">
                    <td>@{{ registro.nro_cuenta }}</td>
                    <td>@{{ registro.nombre_cuenta }}</td>
                    <td>@{{ registro.dominio }}</td>
                    <td><a title='Editar' href="{{route('cuentas.index')}}/@{{ registro.id }}/edit"><i class='glyphicon glyphicon-edit' ></i></a></td>
                </tr>
            </tbody>
        </table>
        <label id="pagina_actual" class="pull-right" >Pagina actual: @{{ pagina_actual }}</label>
    </div>
    <h2 v-show="busqueda == false && lista.length == 0">No se encontraron resultados</h2>

<!--    <pre> @{{ $data | json }} </pre>-->


@endsection

