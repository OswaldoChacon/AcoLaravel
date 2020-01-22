 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<hr>
 <image align="left" src="{{asset('ittg.png')}}"style="idth:200px; height:100px;position:absolute; left:17%; top:30px;" >
<image align="left" src="{{asset('registro.png')}}"style="width:200px; height:100px;position:absolute; right:10%; top:30px;">
<div class=" text-center">
  <br>
  <h1>Instituto Tecnológico de Tuxtla Gutiérrez</h1>
  </image>
  <p>Ingenieria en sistemas computacionales</p> 

</div>
<br><br><br>
<div class="container">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"  href="{{ url('/') }}" >ITTG</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
             <ul class="nav navbar-nav" style="border: 1px solid #b8b894; position: absolute;left: 45%;">
                <li class="dropdown  "><a class="dropdown-toggle" data-toggle="dropdown" href="#">Acceso a Usuarios<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('loginDocente') }}">Docentes</a></li>
                    <li><a href="{{ route('loginAlumno') }}">Alumno</a></li>
                    <li><a href="{{ url('/') }}">Oficina</a></li>
                    <li><a href="{{ route('loginCoordinador') }}">Coordinador</a></li>
                  </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Contacto</a></li>
              <li><a href="#">Quienes somos?</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->

      </nav>

    </div> <!-- /container -->
