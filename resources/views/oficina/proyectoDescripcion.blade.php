@extends('oficina.oficina')

@section('content')

<div class="panel-heading "style="text-align: center; "> <String>{{$foro->noforo}}º  {{$foro->titulo}}</String>
              <br>
              <String>{{$foro->periodo}}  {{$foro->anoo}}  </String>
        </div>
    <div class="col-md-6"><br>
        <table class="table table-bordered" style="width: 750px;height: 100px;">
        <thead>
            <tr>
                <th>Título del Proyecto</th>
                <th>{{$infoProyecto[0]->ProyectoTitulo}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Objetivo general</td>
                <td>{{$infoProyecto[0]->Objetivo}}</td>
            </tr>
            <tr>
                <td>Clave de Investigación</td>
                <td>{{$infoProyecto[0]->ClaveLineaInvestigacion}} </td>
            </tr>
            <tr>
                <td>Línea de investigación</td>
                <td>{{$infoProyecto[0]->LineaInvestigacion}}</td>
            </tr>
             <tr>
                <td>Tipo de Titulación</td>
                <td>{{$infoProyecto[0]->AreaConocimiento}}</td>
            </tr>
            <tr>
                <td>Nombre de la empresa o Institución</td>
                <td>{{$infoProyecto[0]->Empresa}}</td>
            </tr>
        </tbody>
    </div>

  <div class="col-md-6" >
        <table class="table table-bordered" style="width: 750px;height: 50px;">
          <p>Asesor</p>
        <thead>
            <tr>
                <th>Nombre: {{$infoProyecto[0]->PrefijoDocente}} {{$infoProyecto[0]->NombreDocente}} {{$infoProyecto[0]->PaternoDocente}} {{$infoProyecto[0]->MaternoDocente}} </th>

            </tr>
        </thead>
    </div>

<div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 50px;">
          <p>Alumnos</p>
     @foreach($infoProyecto as $alumno)
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>{{$alumno->NombreAlumno}} {{$alumno->PaternoAlumno}} {{$alumno->MaternoAlumno}}</td>
            </tr>
        </tbody>
    @endforeach
    </div>



  <div class="col-md-6">
        <table class="table table-bordered" style="width: 750px;height: 50px;">
          <p>Maestro de Taller</p>
           @foreach($docentesDeTaller as $pt)
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>{{$pt[0]->PrefijoDocente}} {{$pt[0]->NombreDocente}} {{$pt[0]->PaternoDocente}} {{$pt[0]->MaternoDocente}}</td>
            </tr>
        </tbody>

       @endforeach

    </div>

    <div class="col-md-6">
        <table class="table table-bordered"style="width: 750px;height: 50px;">
          <p>Oficina</p>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td>{{$jefeDepartamento->Prefijo}} {{$jefeDepartamento->Nombre}} {{$jefeDepartamento->Paterno}} {{$jefeDepartamento->Materno}}</td>
            </tr>
        </tbody>
    </div>
@endsection
