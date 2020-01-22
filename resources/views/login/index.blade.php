<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            height: 100%;
            /* background: blue; */
        }
    </style>

</head>
<nav class="bg-primary">
    <div style="height: 100px">
    </div>
</nav>

<body>
    <div class="col-12 col-sm-7 col-md-6 col-lg-5 col-xl-4 mb-5 mt-n5 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row">        
                    <div class="col-6">
                        <h5>Iniciar sesión</h5>
                    </div>
                    <div class="col-6 text-right">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="roles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle"></i></button>
                            <div class="dropdown-menu" aria-labelledby="roles">
                                <a class="dropdown-item" href="{{url('/')}}">Oficina</a>
                                <a class="dropdown-item" href="{{url('loginAlumno')}}">Alumno</a>
                                <a class="dropdown-item" href="{{url('loginDocente')}}">Docente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div id="alert-fade">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                </div>
                <div class="row mb-4">
                    <div class="col-6">
                        <img src="{{asset('/img/tecnm.png')}}" class="img-fluid float-left" style="height: 100px">
                    </div>
                    <div class="col-6">
                        <img src="{{asset('/img/logo.png')}}" class="img-fluid float-right" style="height: 100px;">
                    </div>
                </div>
                @yield('forms')
            </div>
        </div>
    </div>

    @yield('content');
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/21cd8d42ed.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#alert-fade").delay(3000).fadeOut("slow");
        });
    </script>
</body>

</html>