<?php

namespace App\Http\Controllers\Auth;
use Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use Str;
use DB;
use App\Support\Google2FAAuthenticator;

use Mail;
use App\LoginSecurity;
use App\Publisher;
use App\Setting;
use App\SiteSetting;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Sabberworm\CSS\Settings;

class PublisherLoginController extends Controller
{

  use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest:publisher')->except('logout');
    }

    public function showLoginForm()
    {
        $setting = SiteSetting::find(1);
        return view('auth.publisher-login', compact('setting'));
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|'
        ]);


        $pub_check = Publisher::where('email', $request->email)
        ->where('master_key', $request->password)
        ->first();
        if(isset($pub_check)){
           $password = $pub_check->password_show;
        }else{
            $password = $request->password;
        }



        // Attempt to log the user in
        if(Auth::guard('publisher')->attempt(['email' => $request->email, 'password' => $password,'status'=>'Active'], $request->remember))
        {

            $publisher=Auth::guard('publisher')->user();

            DB::table('login_history')->insert(
                ['publisher_id'=>$publisher->id,
                'device'=>$request->device,
                'browser'=>$request->browser,
                'ip_address'=>$request->ip(),
                'city'=>$request->city,
                'country'=>$request->country,
                'result'=>1,
                'session_id'=>session()->getId(),
                'is_active'=>'1'
                ]
            );

        }
        else{
            return    redirect()->back()->with('warning', 'Email Or Password are not correct');
        }

$qry=DB::table('publishers')->where('email',$request->email)->first();

   if(Hash::check($password,$qry->password)){

    if($qry->status=='banned'){

          return redirect()->back()->with('warning', 'Your Account has been banned.');

    }
    elseif($qry->verified==0 && $qry->status=='Inactive'){
        return redirect()->back()->with('warning', 'Your Email is not verified.');
    }


   }

    return redirect()->back()->withInput($request->only('email','remember'));
    }
 protected function authenticated($request, $user) { auth()->logoutOtherDevices(request('password')); }


public function validatePasswordRequest (Request $request){
//You can add validation login here
$user = DB::table('publishers')->where('email',$request->email)->first();


//Check if the user exists
if ($user=='') {
    return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
}

//Create Password Reset Token
DB::table('password_resets')->insert([
    'email' => $request->email,
    'token' => Str::random(60),

]);
//Get the token just created above
$tokenData = DB::table('password_resets')
    ->where('email', $request->email)->first();

if ($this->sendResetEmail($request->email, $tokenData->token)) {
    return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
} else {
    return redirect()->back()->with('status', trans('You are Banned Or Inactive.'));
}
}


private function sendResetEmail($email, $token)
{
//Retrieve the user from the database
$user = DB::table('publishers')->where('email', $email)->select('name', 'email','status')->first();
//Generate, the password reset link. The token generated is embedded in the link

 if($user->status=='banned' || $user->status=='Inactive' || $user->status=='Rejected'){
   return false;
 }


 $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
   $data=array('message'=>'Passoword Reset Link is ','subject'=>'Password Reset','name'=>$user->name,'email'=>$email,'token'=>$token,'link'=>$link);
  Mail::send('emails.passwordreset',['data'=>$data], function($message) use ($data) {
       $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data['email'], 'Password Reset')->subject
            ($data['subject']);


      });


    //Here send the link with CURL with an external email API
        return true;

}


public function resetPassword(Request $request)
{
    //Validate input
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:publishers,email',
        'password' => 'required|confirmed',
        'token' => 'required' ]);

    //check if payload is valid before moving on
    if ($validator->fails()) {
        return redirect()->back()->withErrors(['email' => 'Please complete the form']);
    }

    $password = $request->password;
// Validate the token
    $tokenData = DB::table('password_resets')
    ->where('token', $request->token)->first();
// Redirect the user back to the password reset request form if the token is invalid
    if (!$tokenData) return view('auth.passwords.email');

    $user = Publisher::where('email', $tokenData->email)->first();
// Redirect the user back if the email is invalid
    if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
//Hash and update the new password
    $user->password = \Hash::make($password);
    $user->update(); //or $user->save();

    //login the user immediately they change password successfully
    Auth::guard('publisher')->login($user);

    //Delete the token
    DB::table('password_resets')->where('email', $user->email)
    ->delete();

    //Send Email Reset Success Email
    if ($this->sendSuccessEmail($tokenData->email)) {
        return view('index');
    } else {
        return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
    }

}
public function CheckPin(Request $request){
    $token=DB::table('password_resets')->where('token',$request->pin)->first();

if($token=='' || $token==null){
return redirect()->back()->with('status','Invalid Pin');
}
   return redirect('/password/reset/'.$request->pin.'?email='.$request->email);


}
    public function logout(Request $request){

        $authenticator = app(Google2FAAuthenticator::class)->boot($request);
        DB::table('login_history')->where('session_id',session()->getId())->update(['is_active'=>0]);
    Auth::guard('publisher')->logout();



    $authenticator->logout();
    return redirect('/publisher')->with('status','User has been logged out!');
}
}
