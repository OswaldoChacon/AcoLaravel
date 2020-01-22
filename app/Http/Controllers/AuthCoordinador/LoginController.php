<?php

namespace App\Http\Controllers\AuthCoordinador;

use Auth;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    public function showLoginFrom()
    {
        return view('Coordinador.login');
    }

    public function login()
    {
      // return view('Coordinador.login');
       // return redirect()->route('cordiLogin');
       $credentials= $this->validate(request(),[

        $this->username() => 'required|string',
        'password' => 'required|string'
    ]);

    if(Auth::attempt($credentials))
    {
         return redirect()->route('cordiLogin');
    } else 
    {
        return back()
    ->withErrors([$this->username() =>trans('auth.failed')])
    ->withInput(request([$this->username()]));   

    }
       
       
    }    

    public function logout()
    {
        Auth::logout();
        return redirect('Coordinador.login');
    }

    public function username()
    {
        return 'name';
    }

    

    
}
