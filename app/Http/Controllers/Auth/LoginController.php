<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (!auth()->user()) {
            return '/login';
        }

        switch (auth()->user()->role) {
            case 'admin':
                return '/InicioAdmin';
            case 'especialista':
                return '/InicioEsp';
            case 'ambientalista':
                return '/InicioAmb';
            case 'ciudadano':
                return '/InicioCiu';
            default:
                return '/home';
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Uncomment the following line to debug
        // dd($user->role);

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin');
            case 'especialista':
                return redirect()->route('especialista');
            case 'ambientalista':
                return redirect()->route('ambientalista');
            case 'ciudadano':
                return redirect()->route('ciudadano');
            default:
                return redirect('/home');
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}