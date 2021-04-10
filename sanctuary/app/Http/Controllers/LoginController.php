<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function index()
    {
        return view('login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function login(Request $request)
    {   
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        // if(Auth::attempt(array('username' => $input['username'], 'password' => $input['password'])))
        if(Auth::attempt(array('username' => 'grace', 'password' => 'test123')))
        {
            $request->session()->regenerate();

            if (Auth::user()->is_staff == 1) {
                return redirect()->route('staff.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Username And Password Are Wrong.');
        }

    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}