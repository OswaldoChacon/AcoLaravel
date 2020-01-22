<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers\AuthAlumno;

use Auth;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
	
	 public function showLoginFrom()
    {
        // return view('alumno.login');
        return view('login.alumno');
    }

    public function login()
    {
       $credentials= $this->validate(request(),[

            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::guard('alumnos')->attempt($credentials))
        {
             return redirect()->route('alumnoLogin');
        } else 
        {
            return back()
        ->withErrors([$this->username() =>trans('auth.failed')])
        ->withInput(request([$this->username()]));   

        }
    }    

    public function logout()
    {
        Auth::guard('alumnos')->logout();
        return redirect('loginAlumno');
    }

    public function username()
    {
        return 'name_usuario';
    }


   

}

