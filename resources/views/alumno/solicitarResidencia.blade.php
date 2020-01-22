
@extends('alumno.alumno')
@section('content')

<div class="panel-heading">
    <h3>
        <center><strong>Solicitar Residencia</strong></center>
    </h3>
</div>
<form  method="post"  action="/RegistarResi" class="form-center">

{{csrf_field()}}


<br>
<label for="titulo" class="form-control"> <FONT SIZE=4> <strong >Id-Proyecto: </strong> </FONT> {{$control->id_proyecto}} </label>

<input type="hidden" name="id_proyecto" value="{{$control->id_proyecto}}" class="form-control" >


<br>

<label for="titulo" class="form-control" >
       <FONT SIZE=4> <strong > Alumno: </strong> </FONT>
    {{$control->nombre}} {{$control->paterno}} {{$control->materno}} </label>
 {{-- {{$control->nombre}} {{$control->paterno}} {{$control->materno}} --}}
 <br>
 
 <label class="form-control"  ><FONT SIZE=4> <strong >NoControl: </strong> </FONT> {{Auth::guard('alumnos')->user()->nocontro}} </label>

 <input type="hidden" name="id_alumno" value="{{$control->id}}" class="form-control">
 
 

<br>
<label for="titulo" class="form-control" > <FONT SIZE=4> <strong >Asesor:</strong> {{$asesorP->prefijo}}. {{$asesorP->nombre}} {{$asesorP->paterno}} {{$asesorP->materno}}</FONT> </label>

{{-- {{$proyectos->nombre_de_empresa}} --}}

<br>
<label for="titulo"  ><FONT SIZE=4> <strong>Periodo De Realizacion de residencia:</strong></FONT></label>
<br>
			<select style="width:450px" name="periodo">
				<option disabled selected>Periodo</option>
				<option value="Enero-Junio">Enero-Junio</option>
				<option value="Agosto-Diciembre">Agosto-Diciembre</option>
			</select>
			{!! $errors->first('periodo', '<span class="text-danger">:message</span>') !!}


			<select style="width:550px" name="anio">
				<option disabled selected>Año:</option>
				@foreach (range(2019,2030) as $a)
				<option value="{{$a}}">{{$a}}</option>
				@endforeach
			</select>
			{!! $errors->first('anio', '<span class="text-danger">:message</span>') !!}


            <br>
			 <br>
		<label><FONT SIZE=4> <strong>Lugar:</strong></FONT></label>
		<br> 
			<select name="estado"  style="width:450px" >
				<option disabled selected>Estado</option>
				<option value="Aguascalientes">Aguascalientes</option>
				<option value="Baja California">Baja California</option>
				<option value="Baja California Sur">Baja California Sur</option>
				<option value="Campeche">Campeche</option>
				<option value="Chiapas">Chiapas</option>
				<option value="Chihuahua">Chihuahua</option>
				<option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
				<option value="Colima">Colima</option>
				<option value="Durango">Durango</option>
				<option value="Estado de México">Estado de México</option>
				<option value="Guanajuato">Guanajuato</option>
				<option value="Guerrero">Guerrero</option>
				<option value="Hidalgo">Hidalgo</option>
				<option value="Jalisco">Jalisco</option>
				<option value="Michoacán de Ocampo">Michoacán de Ocampo</option>
				<option value="Morelos">Morelos</option>
				<option value="Nayarit">Nayarit</option>
				<option value="Nuevo León">Nuevo León</option>
				<option value="Oaxaca">Oaxaca</option>
				<option value="Puebla">Puebla</option>
				<option value="Querétaro">Querétaro</option>
				<option value="Quintana Roo">Quintana Roo</option>
				<option value="San Luis Potosí">San Luis Potosí</option>
				<option value="Sinaloa">Sinaloa</option>
				<option value="Sonora">Sonora</option>
				<option value="Tabasco">Tabasco</option>
				<option value="Tamaulipas">Tamaulipas</option>
				<option value="Tlaxcala">Tlaxcala</option>
				<option value="Veracruz">Veracruz</option>
				<option value="Yucatán">Yucatán</option>
				<option value="Zacatecas">Zacatecas</option>
				
			</select>
			{!! $errors->first('periodo', '<span class="text-danger">:message</span>') !!}
                   
		<input type="text" name="lugar" select style="height:30px; width:550px"   value="" placeholder="Ciudad">

                
 <br>
<br>
         <label><FONT SIZE=4> <strong>Empresa</strong></FONT></label>
        <br>

					
  <input type="checkbox" name="empresaAct" id="checkboxEnLinea1" value="{{$proyectos->nombre_de_empresa}}"> <FONT SIZE=4> Empresa Actual: {{$proyectos->nombre_de_empresa}}
     
	  
                    <br>
					<script>
		function habilitar(value)
		{
			if(value==true)
			{
				// habilitamos
				document.getElementById("entrada").disabled=false;
			}else if(value==false){
				// deshabilitamos
				document.getElementById("entrada").disabled=true;
			}
		}
	</script>
 <br>
	<div>
		<input type="checkbox" id="check" onchange="habilitar(this.checked);" checked>  Nueva Empresa
	
		<textarea 
				type="text" 
				select style="height:30px; width:550px"
				name="empresaNueva"
				id="entrada" placeholder="Nombre de la nueva empresa "
					></textarea>

					
	</div>
			
		<br>	

<center><button type="submit" class="btn btn-success btn-xs bnt-block">Solicitar Residencia</button></center>
</form>

{{-- <div class="row">
  <div class="col-xs-4">
    <input type="text" class="form-control" placeholder=".col-xs-4">
  </div>
  <div class="col-xs-5">
    <input type="text" class="form-control" placeholder=".col-xs-5">
  </div>
</div> --}}



            @endsection