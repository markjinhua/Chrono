<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Affliate;
use App\VerifyAffliate;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use App\SiteSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AffliateRegisterController extends Controller
{

	   protected $redirectTo;
    public function __construct()
    {
        $this->middleware('guest:affliate');
    }

    public function showRegisterForm()
    {
        return view('auth.affliate-register');
    }


    public function register(Request $request)
    {
    	 $this->validate($request, [
            'email' => 'required|unique:affliates|email',
            'password' => 'required|min:8',

        ]);
    	  $user = Affliate::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
    	   $verifyUser = VerifyAffliate::create([
    'affliate_id' => $user->id,
    'token' => sha1(time())
  ]);
  $smtp_server = SiteSetting::find(1);
  $config = array(
      'driver'     => 'smtp',
      'host'       => $smtp_server->smtp_host,
      'port'       => $smtp_server->smtp_port,
      'username'   => $smtp_server->smtp_user,
      'password'   => $smtp_server->smtp_password,
      'encryption' => $smtp_server->smtp_enc,
      'from'       => array('address' => $smtp_server->from_email, 'name' => $smtp_server->from_name),
      'sendmail'   => '/usr/sbin/sendmail -bs',
      'pretend'    => false,
  );
  Config::set('mail', $config);

  \Mail::to($user->email)->send(new VerifyMail($user));
        return $user;

        }
public function verifyUser($token)
{
  $verifyUser = VerifyAffliate::where('token', $token)->first();
  if(isset($verifyUser) ){
    $user = $verifyUser->affliate;
    if(!$user->verified) {
      $verifyUser->affliate->verified = 1;
      $verifyUser->affliate->save();
      $status = "Your e-mail is verified. Wait For Admin To Verify.";
    } else {
      $status = "Your e-mail is already verified.  Wait For Admin To Verify.";
    }
  } else {
    return redirect('/affliate/login')->with('warning', "Sorry your email cannot be identified.");
  }
  return redirect('/affliate/login')->with('status', $status);
}
}
