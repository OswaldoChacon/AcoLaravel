@extends('oficina.oficina')

@section('content')
<div class="card">
    <h5 class="card-header">Proyectos participantes</h5>
    <div class="card-body">
    <table class="table">                
        @foreach($proyectos as $proyecto)   
        <tr>                         
        <td>{{$proyecto->id}}</td>
        <!-- <td>{{$proyecto->name}}</td> -->
            @foreach($proyecto->maestroList as $key => $maestro)            
                <!-- <td>{{$maestro->nombre}}</td> -->
                <td>                                    
                    <!-- <div> -->
                    <a href="#posicion-{{$proyecto->id}}-{{$key}}" data-toggle="collapse" aria-expanded="false">{{$maestro->nombre}}</a>
                        <ul class="collapse list-unstyled" id="posicion-{{$proyecto->id}}-{{$key}}">
                            @foreach($maestro->horario as $itemHorarios)
                            <li>
                                {{$itemHorarios}}                                                            
                            </li>
                            @endforeach
                        </ul>                          
                    <!-- </div>              -->
                </td>                    
            @endforeach               
        </tr>
        @endforeach        
    </table>
    </div>
</div>
<!-- <script src="{{asset('js/jquery.js')}}"></script> -->
@endsection