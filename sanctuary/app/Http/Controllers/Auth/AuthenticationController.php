<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (auth()->user()->is_staff == 1) {
            return redirect()->route('staff.home');
        }
        else{
            return redirect()->route('home');
        }
    }
}
