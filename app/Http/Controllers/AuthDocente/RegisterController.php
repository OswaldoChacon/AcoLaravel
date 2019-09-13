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

      $validator = $this->validate(request(),[
        'name' => 'required',
        'email' => 'email|required',
        'nombre' => 'required',
        'paterno' => 'required',
        'materno' => 'required',
        'matricula' => 'required',
        'password' => 'required',
        'prefijo' => 'required',
      ]);
    $token=Tokendocente::where('id_usuario',$request->email)->first();
    $name=Docente::where('name',$request->name)->first();
    $email=Docente::where('email',$request->email)->first();
  if($token!=null && $name== null&& $email== null)
    {
      if($token->uso==0)
      {

       $docente=Docente::create([
            'name' => $request->name,
            'email' => $request->email,
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'matricula' => $request->matricula,
            'prefijo' => $request->prefijo,
            'acceso'=>0,
            'password' =>Hash::make($request->password),         
                   ]);
                  
        $token->uso=1;
        $token->save();
        return redirect("loginDocente");
      }else
      {
         return redirect("loginDocente");
      }

    }
    else
    {
      return view('docentes.registro');
    }


    }

  
}
