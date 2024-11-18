<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffliateLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:affliate')->except('logout');
    }

    public function showLoginForm()
    {
  

        return view('auth.affliate-login');
    }


    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|',

        ]);

        // Attempt to log the user in
        if(Auth::guard('affliate')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>'Active'], $request->remember))
        {
            return redirect('beforelogin');
        }

        // if unsuccessful
        return redirect()->back()->withInput($request->only('email','remember'));
    }


   public function logout(){
    Auth::guard('affliate')->logout();
    return redirect('/affliate')->with('status','User has been logged out!');
}
}