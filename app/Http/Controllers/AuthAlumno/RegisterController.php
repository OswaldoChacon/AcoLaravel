<?php


namespace App\Http\Controllers;


namespace App\Http\Controllers\AuthAlumno;

use App\User;
use App\Alumno;
use Illuminate\Http\Request;
use DB;
use App\Tokenalumno;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    

      public function showLoginFrom()
    {
        return view('alumno.registro');
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
        'name_usuario' => 'required',
        'email' => 'email|required',
        'nombre' => 'required',
        'paterno' => 'required',
        'materno' => 'required',
        'nocontro' => 'required',
        'password' => 'required',
      ]);
      // dd($request);
    $token=Tokenalumno::where('numerocontrol',$request->nocontro)->first();
    // dd($token->id);
    $name=Alumno::where('name_usuario',$request->name_usuario)->first();
    $email=Alumno::where('email',$request->email)->first();
  if($token!=null && $name== null&& $email== null)
    {
      if($token->uso==0)
      {
      $docente=Alumno::create([
            'name_usuario' => $request->name_usuario,
            'email' => $request->email,
            'nombre' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            // 'id_profe'=>$token->profe,
            'tokenalumnos_id'=> $token->id,
            'nocontro' => $request->nocontro,
            'grupo'=>$token->grupo,
            'acceso'=>0,        
            'password' => Hash::make($request->password),            
                   ]);
        $token->uso=1;
        // $token->id_usuario=$request->email;
        $token->save();
        return redirect("loginAlumno");
      }else
      {
         return redirect("registroAlumno");
      }

    }
    else
    {
      return view('alumno.registro');
    }


    }

   
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
