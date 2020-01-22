<?php

namespace App\Http\Controllers\AuthDocente;

use Auth;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    public function showLoginFrom()
    {
        return view('docentes.login.login');
    }

    public function login()
    {
        $credentials = $this->validate(request(), [

            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);        
        if (Auth::guard('docentes')->attempt($credentials)) {
            return redirect()->route('docenteLogin');
        } else {
            return back()
                ->withErrors([$this->username() => trans('auth.failed')])
                ->withInput(request([$this->username()]));
        }
    }

    public function logout()
    {
        Auth::guard('docentes')->logout();
        return redirect('loginDocente');
    }

    public function username()
    {
        return 'name_usuario';
    }
}
