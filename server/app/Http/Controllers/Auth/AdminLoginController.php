<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // return $request;
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|'
        ]);

        // Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect('/admin') ;
        }

        // if unsuccessful
        return redirect()->back()->withInput($request->only('email','remember'));
    }

   public function logout(){
    Auth::guard('admin')->logout();
    return redirect('/admin')->with('status','User has been logged out!');
}
}
