@extends('docentes.docente')

@section('content')

<div class="card">
    <h5 class="card-header">Segumiento desde docente</h5>
    <div class="card-body">
        <div class="table-responsive">
            {{csrf_field()}}
            <table class="table table-striped table-hover tableForos">
              
                <thead>
                    <th>id</th>
                    <th>id_docente</th>
                    <th>id_proyecto</th>
                </thead>
                <tbody style="table-layout:fixed">
           @foreach($idp2 as $Proyectosunny)
                <tr>
                
                    <td>
    
                    {{$Proyectosunny->id}}
         
                    </td>
                     
                    <td>
                       {{$Proyectosunny->id_docente}}
                    </td>
               
                 <td>
                    {{$Proyectosunny->id_proyecto}}
                    </td>
                    <td>
                    <a class="btn btn-info btn-xs" >Seguimiento de Proyecto</a>
                    </td>
                    @endforeach 
                </tbody>

        </div>
    </div>
</div>
@endsection
