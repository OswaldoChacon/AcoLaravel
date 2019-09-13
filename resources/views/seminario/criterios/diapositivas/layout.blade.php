@extends('oficina.oficina')

@section('content')
<div class="panel-heading">
	<header>
		<ul class="nav nav-pills nav-justified">
			<li class="active"><a href="{{ route('diapositivas.create') }}">Crear Criterios</a></li>
			<li><a href="{{ route('diapositivas.index') }}">Criterios de Diapositivas</a></li>
		</ul>
	</header>
</div>

@yield('contenido')
@endsection