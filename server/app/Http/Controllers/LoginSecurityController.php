<?php

namespace App\Http\Controllers;

use App\LoginSecurity;
use App\AdminSecurity;
use App\AffliateSecurity;
use Auth;
use Hash;
use Illuminate\Http\Request;

class LoginSecurityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    /**
     * Show 2FA Setting form
     */
    public function show2faForm(Request $request){
        $this->middleware('auth:publisher');
        $user = Auth::guard('publisher')->user();
        $google2fa_url = "";
        $secret_key = "";

        if($user->loginSecurity()->exists()){
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                'DreamAff',
                $user->email,
                $user->loginSecurity->google2fa_secret
            );
            $secret_key = $user->loginSecurity->google2fa_secret;
        }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url
        );

        return view('auth.2fa_settings')->with('data', $data);
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecret(Request $request){
         $this->middleware('auth:publisher');
        $user = Auth::guard('publisher')->user();
        // Initialise the 2FA class
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security = LoginSecurity::firstOrNew(array('publisher_id' => $user->id));
        $login_security->publisher_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('publisher/2fa')->with('success',"Secret key is generated.");
    }

    /**
     * Enable 2FA
     */
    public function enable2fa(Request $request){
         $this->middleware('auth:publisher');
        $user = Auth::guard('publisher')->user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->loginSecurity->google2fa_secret, $secret);

        if($valid){
            $user->loginSecurity->google2fa_enable = 1;
            $user->loginSecurity->save();
            return redirect('publisher/2fa')->with('success',"2FA is enabled successfully.");
        }else{
            return redirect('publisher/2fa')->with('error',"Invalid verification Code, Please try again.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request){
         $this->middleware('auth:publisher');
        if (!(Hash::check($request->get('current-password'), Auth::guard('publisher')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::guard('publisher')->user();
        $user->loginSecurity->google2fa_enable = 0;
        $user->loginSecurity->save();
        return redirect('publisher/2fa')->with('success',"2FA is now disabled.");
    }




















  public function show2faFormAdmin(Request $request){
     $this->middleware('auth:admin');
        $user = Auth::guard('admin')->user();
        $google2fa_url = "";
        $secret_key = "";

        if($user->AdminSecurity()->exists()){

            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                'DreamAff Admin',
                $user->email,
                $user->adminSecurity->google2fa_secret
            );
            $secret_key = $user->adminSecurity->google2fa_secret;
             }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url
        );

        return view('admin.2fa_settings')->with('data', $data);
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecretAdmin(Request $request){
         $this->middleware('auth:admin');
        $user = Auth::guard('admin')->user();
        // Initialise the 2FA class
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security = AdminSecurity::firstOrNew(array('admin_id' => $user->id));
        $login_security->admin_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('admin/2fa')->with('success',"Secret key is generated.");
    }

    /**
     * Enable 2FA
     */
    public function enable2faAdmin(Request $request){
         $this->middleware('auth:admin');
        $user = Auth::guard('admin')->user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->adminSecurity->google2fa_secret, $secret);

        if($valid){
            $user->adminSecurity->google2fa_enable = 1;
            $user->adminSecurity->save();
            return redirect('admin/2fa')->with('success',"2FA is enabled successfully.");
        }else{
            return redirect('admin/2fa')->with('error',"Invalid verification Code, Please try again.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2faAdmin(Request $request){
         $this->middleware('auth:admin');

        if (!(Hash::check($request->get('current-password'), Auth::guard('admin')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::guard('admin')->user();
        $user->adminSecurity->google2fa_enable = 0;
        $user->adminSecurity->save();
        return redirect('admin/2fa')->with('success',"2FA is now disabled.");
    }



















  public function show2faFormAffliate(Request $request){
     $this->middleware('auth:affliate');
        $user = Auth::guard('affliate')->user();
        $google2fa_url = "";
        $secret_key = "";

        if($user->AffliateSecurity()->exists()){

            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                'DreamAff',
                $user->email,
                $user->affliateSecurity->google2fa_secret
            );
            $secret_key = $user->affliateSecurity->google2fa_secret;
             }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url
        );

        return view('affliate.2fa_settings')->with('data', $data);
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecretAffliate(Request $request){
         $this->middleware('auth:affliate');
        $user = Auth::guard('affliate')->user();
        // Initialise the 2FA class
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security =AffliateSecurity::firstOrNew(array('affliate_id' => $user->id));
        $login_security->affliate_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();


        return redirect('affliate/2fa')->with('success',"Secret key is generated.");
    }

    /**
     * Enable 2FA
     */
    public function enable2faAffliate(Request $request){
         $this->middleware('auth:affliate');
        $user = Auth::guard('affliate')->user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->affliateSecurity->google2fa_secret, $secret);

        if($valid){
            $user->affliateSecurity->google2fa_enable = 1;
            $user->affliateSecurity->save();
            return redirect('affliate/2fa')->with('success',"2FA is enabled successfully.");
        }else{
            return redirect('affliate/2fa')->with('error',"Invalid verification Code, Please try again.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2faAffliate(Request $request){
         $this->middleware('auth:affliate');
 
        if (!(Hash::check($request->get('current-password'), Auth::guard('affliate')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);
        $user = Auth::guard('affliate')->user();
        $user->affliateSecurity->google2fa_enable = 0;
        $user->affliateSecurity->save();
        return redirect('affliate/2fa')->with('success',"2FA is now disabled.");
    }




}