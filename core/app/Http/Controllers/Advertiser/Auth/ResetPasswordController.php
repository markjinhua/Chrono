<?php

namespace App\Http\Controllers\Advertiser\Auth;

use App\Http\Controllers\Controller;
use App\Models\Advertiser;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;


    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {

        $email = session('fpass_email');
        $token = session()->has('token') ? session('token') : $token;
        if (PasswordReset::where('token', $token)->where('email', $email)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return to_route('advertiser.password.request')->withNotify($notify);
        }
        return view('Template::advertiser.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email, 'pageTitle' => 'Reset Password']
        );
    }

    public function reset(Request $request)
    {

        session()->put('fpass_email', $request->email);
        $request->validate($this->rules(), $this->validationErrorMessages());
        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        if (!$reset) {
            $notify[] = ['error', 'Invalid verification code'];
            return to_route('advertiser.login')->withNotify($notify);
        }

        $user = Advertiser::where('email', $reset->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        notify($user, 'PASS_RESET_DONE', [
            'operating_system' => @$userBrowser['os_platform'],
            'browser' => @$userBrowser['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ], ['email']);


        $notify[] = ['success', 'Password changed successfully'];
        return to_route('advertiser.login')->withNotify($notify);
    }



    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        $passwordValidation = Password::min(6);
        if (gs('secure_password')) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', $passwordValidation],
        ];
    }
}