<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:web')->except('logout');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // return redirect('admin/dashboard');
            return redirect()->intended('admin/dashboard');
        }elseif (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect('/');
        }else{
            return back()->withErrors(['error' => 'Email/Password Salah!']);
        }
    }
}
