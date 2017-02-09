<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Secure Talk Panel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/HoldOn.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Secure Talk Panel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (!Auth::guest())
                    @if(Auth::user()->getTypeUser() == 1)
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('cuentas.index') }}">Cuentas</a></li>
                        </ul>
                    @endif
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        @if(Auth::user()->getTypeUser() == 1)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @else if(Auth::user()->ggetTypeUser() == 2)
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/home') }}">Tipo de usuario 2</a></li>
                            </ul>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="main">
        @yield('content')
    </div>
    @include("components.modal")
    <!-- JavaScripts -->
    <!-- JQuery 2.2.3 -->
    <script src="{{ url('assets/js/jquery.js') }}" ></script>
    <script src="{{ url('assets/js/vue.js') }}" ></script>
    <script src="{{ url('assets/js/HoldOn.js') }}" ></script>

    <script>

        /*
        Possible types: "sk-cube-grid", "sk-bounce", "sk-folding-cube","sk-circle","sk-dot","sk-falding-circle"
                        "sk-cube-grid", "custom"
        */

        function cargando(type,message){
            HoldOn.open({
                theme: type,
                message:"<h4>"+message+"</h4>"
            });

            setTimeout(function(){
                HoldOn.close();
            },300000);
        }

        function traerResultados(url)
        {
            cargando('Buscando resultados');
            $.ajax({
                type: "GET",
                url: url,
                assync: false,
                success: function(data){
                    mostrarDatos(data);
                    HoldOn.close();
                }
            });
        }



        function peticionAjax(destino,datos,redireccionar)
        {
            redireccionar = redireccionar || 0;
            cargando('Guardando...');
            $.ajax({
                type: "Post",
                url: destino,
                data: datos,
                assync: true,
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){

                    //                console.log(respuesta);
                    if(isNaN(respuesta) ) {
                        if(respuesta.substr(0,4) == "http")
                        {
                            window.location.href = respuesta;
                            respuesta = "Datos guardados correctamente";
//                        HoldOn.close();
                        }

                        $("#contenido-modal").html(respuesta);
                        $("#confirmacion").modal(function(){show:true});
//                    HoldOn.close();
                    }
                    else
                    {
                        //                    $("#id_persona").val(respuesta);
                        $("#contenido-modal").html("Datos guardados correctamente");
                        $("#confirmacion").modal(function(){show:true});
//                    HoldOn.close();
                    }
                    HoldOn.close();
                },
                error: function(result) {
                    $("#contenido-modal").html("Hubo un error, consulta con el administrador");
                    $("#confirmacion").modal(function(){show:true});
                    HoldOn.close();
                }


            });
        }

        function darMensaje(mensaje)
        {
            $("#contenido-modal").html(mensaje);
            $("#confirmacion").modal(function(){show:true});
        }


    </script>


    <!-- Bootstrap 3.3.6 -->
    <script src="{{ url('assets/js/bootstrap.min.js') }}" ></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('scripts')
</body>
</html>
