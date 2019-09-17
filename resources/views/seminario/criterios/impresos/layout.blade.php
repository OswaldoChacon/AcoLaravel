@extends('oficina.oficina')

@section('content')
<!-- <div class="panel-heading">
	<header>
		<ul class="nav nav-pills nav-justified">
			<li class="active"><a href="{{ route('impresos.create') }}">Crear Criterios</a></li>
			<li><a href="{{ route('impresos.index') }}">Criterios del  Documento Impreso</a></li>
		</ul>
	</header>
</div> -->
<div class="card">
	@yield('contenido')
</div>

@endsection