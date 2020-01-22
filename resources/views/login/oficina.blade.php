@extends('login.index')
@section('forms')
<form method="POST" action="{{route('login')}}">
    @csrf
    <div class="input-group input-group-sm mb-2 ">
        <div class="input-group-prepend">
            <span class="input-group-text">@</span>
        </div>
        <input type="text" name="name" class="form-control" placeholder="Email">
    </div>
    {!! $errors->first('email','<span class="text-danger">:message</span>')!!}
    <div class="input-group input-group-sm mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-key icon"></i>
            </span>
        </div>
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
    </div>
    {!! $errors->first('password','<span class="text-danger">:message</span>')!!}
    <button type="submit" class="btn btn-success btn-sm col">Iniciar sesión</button>
</form>
@endsection