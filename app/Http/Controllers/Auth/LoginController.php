<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    public function showLoginFrom()
    {
        return view('oficina.login');
    }

    public function login()
    {
       $credentials= $this->validate(request(),[

            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credentials))
        {
             return redirect()->route('oficina');
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
        return redirect('/');
    }

    public function username()
    {
        return 'name';
    }

    
}
