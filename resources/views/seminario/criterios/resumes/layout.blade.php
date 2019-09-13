@extends('oficina.oficina')

@section('content')
<div class="panel-heading">
	<header>
		<ul class="nav nav-pills nav-justified">
			<li class="active"><a href="{{ route('resumes.create') }}">Crear Criterios</a></li>
			<li><a href="{{ route('resumes.index') }}">Criterios de Resumen</a></li>
		</ul>
	</header>
</div>

@yield('contenido')
@endsection