@extends('oficina.oficina')

@section('content')
<!-- <div class="container-fluid"> -->
<div class="row">
  <div class="card col-xl-4 col-md-5">
    <h5 class="card-header">Registrar linea de investigación</h5>
    <div class="card-body">
      <form method="post" action="{{ route('lineaDeInvetigacionguardar') }}" class="form-center">
        {{csrf_field()}}
        @if (Session::has('success'))
        <div class="alert alert alert-success" id="alert-fade">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert alert-danger" id="alert-fade">{{ Session::get('error') }}</div>
        @endif
        <div class="form-group ">
          <label for="name">Clave</label>
          <input class="form-control" type="text" name="clave" placeholder='Clave'>
          @if ($errors->has('clave'))
          <span class="text-danger">{{ $errors->first('clave') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="name">Nombre</label>
          <input class="form-control" type="text" name="nombre" placeholder='Lineas de Investigacion'>
          @if ($errors->has('nombre'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
          @endif
        </div>
        <button type="submit" class="btn btn-primary btn-sm" value="Registrar" name="">Guardar</button>
      </form>
    </div>
  </div>




  <div class="card col-xl-7 col-md-6">
    <h5 class="card-header">Lineas de Investigacion: <span style="font-weight: bold">{{$lineadeinvestigacion->count()}}</span></h5>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <th>Clave</th>
            <th>Nombre</th>
          </thead>
          <tbody>
            @foreach ($lineadeinvestigacion as $linea)
            <tr>
              <td>{{$linea->clave}}</td>
              <td>{{$linea->linea}}</td>
              <td>
                <form action="{{url('/LineaDeInvestigacioneliminar/'.Crypt::encrypt($linea->id)) }}" method="POST">
                  {{ csrf_field() }} {{ method_field('delete') }}
                  <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                </form>
              </td>
              <td>
                <button class="btn btn-warning btn-sm edit" data-toggle="modal" data-target="#editModal_{{$linea->id}}"><i class="far fa-edit"></i></button>
                <div class="modal fade" id="editModal_{{$linea->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <!-- <form class="form-center" action="{{url('/LineaDeInvestigacioneditar/'.Crypt::encrypt($linea->id)) }}" method="POST"> -->
                      <form class="form-center">
                        {{csrf_field()}} {{ method_field('put') }}
                        <input type="hidden" name="idLinea" value="{{$linea->id}}" />
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Editar linea de inv.</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Clave </label>
                            <input type="text" name="clave" value="{{$linea->clave}}" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Nombre </label>
                            <input type="text" name="nombre" value="{{$linea->linea}}" class="form-control" />
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-primary btn-sm editar">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              </td>
            </tr>
            @endforeach
          </tbody>
      </div>
    </div>
  </div>
</div>


<script src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
<script>
  $(document).on('click', '.modal .editar', function() {
    // $('.editar').on('click', function() {    
    var element = $(this).parent().parent();
    var idLinea = element.find('input[name="idLinea"]').val();
    var clave = element.find("input[name='clave']").val();
    var nombre = element.find("input[name='nombre']").val();
    // var nombre = $(this).data('')
    // var nombre = $('input[name="nombre"]').val();        
    var token = $("[name='_token']").val();
    $(".loaderContainer").addClass('active');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': token
      },
      type: 'put',
      url: '/LineaDeInvestigacioneditar',
      data: {
        'idLinea': idLinea,
        'clave': clave,
        'nombre': nombre
      },
      success: function() {
        $(".loaderContainer").removeClass('active');
        location.reload();
      },
      error: function(error) {
        var er = error.responseJSON.errors;
        console.log(er);
        $.each(er, function(name, message) {
          $('.modal-body input[name=' + name + ']').after('<span class="text-danger">' + message + '</span>');
        })
        $(".loaderContainer").removeClass('active');
        setTimeout(() => {
          $('.modal-body').find('span').hide('fade');
        }, 3000);
        // setTimeout(function () { $('#alert-fade').hide("fade"); }, duration);
        // $(".messageContainer").addClass('active');
        // $(".messageContainer .message .title p").text('¡Error!');
        // $(".messageContainer .message .description p").text('Ocurrió un error al intentar conectar al servidor. Inténtelo más tarde.');
        // setTimeout(() => {
        //     $(".messageContainer").removeClass('active');
        // }, 3000);
      }
    });
  });
</script>
@endsection