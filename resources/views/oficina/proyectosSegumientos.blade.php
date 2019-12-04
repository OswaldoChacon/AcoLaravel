@extends('oficina.oficina')

@section('content')
<div class="card">
    <h5 class="card-header">Seguimento de Proyectos</h5>
    <div class="card-body">
        <div class="table-responsive">
            {{csrf_field()}}
            <table class="table table-striped table-hover tableForos">
                <thead>
                    <th>
                        <select name="foros" class="form-control">
                            <option value="seleccione"> Elige foro aal </option>
                           
                        </select>
                    </th>
                    <th>
                        <button class="btn btn-success btn-xs bnt-block btnBuscarForos">Buscar</button>
                    </th>
                </thead>
                <thead>
                    <th>Folio</th>
                    <th>Título del proyecto</th>
                
                </thead>
                <tbody style="table-layout:fixed">

                </tbody>
        </div>
    </div>

</div>
@endsection