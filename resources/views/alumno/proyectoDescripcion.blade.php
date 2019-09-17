@extends('alumno.alumno')

@section('content')

<div class="card">
    <div class="card-header">
        <String>{{$foro->noforo}}º {{$foro->titulo}}</String>
        <br>
        <String>{{$foro->periodo}} {{$foro->anoo}} </String>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título del Proyecto</th>
                        <th>{{$proyectoForo->titulo}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Objetivo general</th>
                        <td>{{$proyectoForo->objetivo}}</td>
                    </tr>
                    <tr>
                        <th>Línea de Investigación</th>
                        <td>{{$proyectoForo->linea}}</td>
                    </tr>
                    <tr>
                        <th>Tipo de Titulación</th>
                        <td>{{$proyectoForo->area}}</td>
                    </tr>
                    <tr>
                        <th>Nombre de la empresa o Institución</th>
                        <td>{{$proyectoForo->nombre_de_empresa}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="table-responsive col-lg-6">
                <table class="table table-bordered">
                    <p>Asesor</p>
                    <thead>
                        <tr>
                            <th>Nombre </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($docente as $doc)
                            @if ($proyectoForo->assesor==$doc->id)
                            <td>{{$doc->prefijo}}. {{$doc->nombre}} {{$doc->paterno}} {{$doc->materno}}</td>
                            @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive col-lg-6">
                <table class="table table-bordered">
                    <p>Alumnos</p>
                    @foreach($alumnoenproyecto as $fd)
                    @foreach($alumno as $alm)
                    @if ($fd->titulo==$proyectoForo->titulo)
                    @if ($fd->id_alumno==$alm->id)

                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$alm->nombre}} {{$alm->paterno}} {{$alm->materno}}</td>
                        </tr>
                    </tbody>
                    @endif
                    @endif
                    @endforeach
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive col-lg-6">
                <table class="table table-bordered">
                    <p>Maestro de Taller</p>
                    @foreach($Forodoncente as $fd)
                    @if ($foro->noforo==$fd->id_foro)
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$fd->n_profe}}</td>
                        </tr>
                    </tbody>
                    @endif
                    @endforeach
                </table>
            </div>

            <div class="table-responsive col-lg-6">
                <table class="table table-bordered">
                    <p>Oficina</p>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$foro->oficina}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <ul class="pager nav navbar-nav navbar-right" style="position: absolute; top:-70px; left:650px;">
            <li><a href="/descarga/{{$ProyectoForoAlumno->id}}">Descargar</a></li>
        </ul>
    </div>
</div>









@endsection