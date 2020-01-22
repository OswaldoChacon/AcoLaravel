@extends('docentes.docente')

@section('content')

<div class="card">
    <h5 class="card-header">Segumiento De Proyectos</h5>
    <div class="card-body">
        <div class="table-responsive">
            {{csrf_field()}}
            <table class="table table-striped table-hover tableForos">
              
                <thead>
                    {{-- <th>id</th> --}}
                    <th>id_proyecto</th>
                    <th>Titulo</th>
                    
                    <th>Acciones</th>
                </thead>
                <tbody style="table-layout:fixed">
               @foreach($idp2 as $Proyectosunny)
        
                <tr>
                
                   {{--  <td>
    
                    {{$Proyectosunny->id}}
         
                    </td> --}}
                      <td >
                    {{$Proyectosunny->id_proyecto}}
                    </td>
                    
                     
                    <td>
                     @foreach($nombreProyecto as $Proyectos)

                       @if(($Proyectosunny->id_proyecto)==($Proyectos->id))
                   {{$Proyectos->titulo}}
               @endif
                 @endforeach 

                     
                    </td>
               
               
                    {{-- $id2 = {{$Proyectosunny->id_proyecto}}; --}}
                    

                    <td> 
                    <a class="btn btn-info btn-xs" href="{{ route('proyectossegui',['id_pro' => $Proyectosunny->id_proyecto ] ) }}">Seguimiento de Proyecto</a>
                    </td>
               
                    @endforeach 
                </tbody>
 
    </div>
</div>

<meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
 
    <script>
    $(document).ready(function(){
        $(".boton").click(function(){
 
            var valores="";
 
            // Obtenemos todos los valores contenidos en los <td> de la fila
            // seleccionada
            $(this).parents("tr").find("td").each(function(){
                valores+=$(this).html()+"\n";
            });
 
            alert(valores);

                 
        });
    });
    </script>
 
    <style>
        .boton {border:1px solid #808080;cursor:pointer;padding:2px 5px;color:Blue;}
    </style>
</head>
 




@endsection
