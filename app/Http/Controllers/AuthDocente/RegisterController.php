<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\AuthDocente;

use App\User;
use App\Docente;
use Illuminate\Http\Request;
use DB;
use App\Tokendocente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{

  public function showLoginFrom()
  {
    return view('docentes.registro');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(Request $request)
  {

    $validator = $this->validate(request(), [
      'matricula' => 'required',    
      'name' => 'required',
      'email' => 'email|required',
      'nombre' => 'required',
      'paterno' => 'required',
      'materno' => 'required',    
      'password' => 'required',
      'prefijo' => 'required',
    ]);
    $token = Tokendocente::where('matricula', $request->matricula)->first();    
    $name = Docente::where('name_usuario', $request->name)->first();
    $email = Docente::where('email', $request->email)->first();
    if ($token != null && $name == null && $email == null) {
      if ($token->uso == 0) {

        $docente = Docente::create([
          'name_usuario' => $request->name,
          'email' => $request->email,
          'nombre' => $request->nombre,
          'paterno' => $request->paterno,
          'materno' => $request->materno,
          'prefijo' => $request->prefijo,
          'matricula' => $request->matricula,          
          'acceso' => 0,
          'password' => Hash::make($request->password),
          'id_tokendocentes'=>$token->id
        ]);

        $token->uso = 1;        
        $token->save();
        return redirect("loginDocente");
      } else {
        return redirect("loginDocente");
      }
    } else {
      return view('docentes.registro');
    }
  }
}
