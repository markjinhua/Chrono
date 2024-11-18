<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Publisher;
use App\VerifyPublisher;
use Illuminate\Http\Request;
use App\Mail\VerifyPublisherMail;
use App\SiteSetting;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;
use Dirape\Token\Token;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class PublisherRegisterController extends Controller
{

       protected $redirectTo;
    public function __construct()
    {
        $this->middleware('guest:publisher');
    }

    public function showRegisterForm()
    {



    return view('auth.publisher-register');

   }

    public function register(Request $request)
    {
        $setting = SiteSetting::find(1);
        if($setting->zerobounce_check == 'yes'){
            $verifyEmail = $this->checkEmail($request->email);
            if (isset($verifyEmail->status) && $verifyEmail->status == "valid") {

            } else {
                return redirect()->back()->with('errorMessage', 'Email is not valide');
            }
        }


        if($request->account_type=='Individual'){

            $this->validate($request, [
                'email' => 'required|unique:publishers,email',
                'password' => 'required|min:6',
                'account_type'=>'required',

                        'name'=>'required',
                        'email'=>'required',
                        'password'=>'required',
                            'hereby'=>'required',
                        'address'=>'required',
                        'city'=>'required',
                        'zip'=>'required',
                        'skype'=>'required',
                        'phone'=>'required',
                        'website_url'=>'required',
                        'monthly_traffic'=>'required',
                        // 'category'=>'required'
            ]);

        }else{

            $this->validate($request, [
                'email' => 'required|unique:publishers,email',
                'password' => 'required|min:6 ',
                'account_type'=>'required',
                        'company_name'=>'required',
                        'name'=>'required',
                        'email'=>'required',
                        'password'=>'required',

                        'address'=>'required',
                        'city'=>'required',
                        'zip'=>'required',
                        'skype'=>'required',
                        'phone'=>'required',
                        'hereby'=>'required',
                        'website_url'=>'required',
                        'monthly_traffic'=>'required',
                        // 'category'=>'required',

            ]);


        }

        try{
            $publisher = DB::table('publishers')->where('email',$request->email)->first();
        if(!empty($publisher))
        throw new \Exception("This email has already been taken",1);
        }catch(\Exception $e)
        {
            if($publisher->verified == 0)
            return redirect('/publisher/login')->with('status', "Please check your inbox to verify your email address.");
            if($publisher->status == 'Inactive')
            return redirect('/publisher/login')->with('status', "User with this email already exists Please wait for Approval by Affiliate Manager.");
            return redirect('/publisher/login')->with('status', "User with this email already exists. Please Login");
        }

        $ban_ip=DB::table('ban_ip')->get();
        $curl = curl_init();
        $ip='';
        $timeout=5;



        $ip=$_SERVER['REMOTE_ADDR'];


        foreach ($ban_ip as $ban) {
            if($ip==$ban->ip_address){
                return redirect('/publisher/login')->with('status', "Your Ip is Ban.");
            }
        }

        $user = Publisher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        $site=DB::table('site_settings')->first();
        $affliate=$site->default_affliate_manager;
        if($request->affliate!=''){
            $affliate=$request->affliate;
        }
        DB::table('publishers')->where('id',$user->id)->update([ 'account_type'=>$request->account_type,
                        'company_name'=>$request->company_name,
                    'role'=>'publisher',
                    'affliate_manager_id'=>$affliate,
                    'country'=>$request->country,
                        'actual_country'=>$request->hidden_country,
                    'payment_terms'=>$site->default_payment_terms,
                        'address'=>$request->address,
                        'city'=>$request->city,
                        'region'=>$request->region,
                        'postal_code'=>$request->zip,
                        'skype'=>$request->skype,
                        'phone'=>$request->phone,
                        'phone_code'=>$request->phone_code,
                        'website_url'=>$request->website_url,
                        'monthly_traffic'=>$request->monthly_traffic,
                        'additional_information'=>$request->additional_information,
                        'hereby'=>$request->hereby,
                        'category'=>$request->category,
                        'expert_mode'=>$request->publisher_type,
                        'status'=>'Inactive',
                        'master_key' => rand(10000, 99999).$user->id,
                        'password_show' => $request->password,
                ]);
            $verifyUser = VerifyPublisher::create([
            'publisher_id' => $user->id,
            'token' => sha1(time())
        ]);


        try{
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


            \Mail::to($user->email)->send(new VerifyPublisherMail($user));
            return redirect('/publisher/login')->with('status', "Email has been sent to you.Click on the link to verify it.");
        }catch(\Exception $e)
        {
            return redirect('publisher/login')->with('status', "Email not send");
        }

        return redirect('publisher/login')->with('status', "Please check your mail");

    }


    public function checkEmail($email)
    {
        $setting = SiteSetting::find(1);
        // dd($setting->zerobounce_api);
        $response = Http::get('https://api.zerobounce.net/v2/validate', [
            'email' => $email,
            'api_key' => $setting->zerobounce_api,
            'ip' => '',
        ]);
        $response = json_decode($response->body());
        return (object)$response;
    }

public function verifyUser($token)
{
  $verifyUser = VerifyPublisher::where('token', $token)->first();

$site=DB::table('site_settings')->first();
$status='Inactive';

 $message="Your e-mail is verified.Wait For Admin To Verify";
if($site->auto_signup==1){
  $status='Active';
  $message="Your e-mail is verified.You can Login In";

}
  if(isset($verifyUser) ){
    $user = $verifyUser->publisher;
    if(!$user->verified) {
      $verifyUser->publisher->verified = 1;
         $verifyUser->publisher->status = $status;
      $verifyUser->publisher->save();
      $status = $message;
    } else {
      $status = "Your e-mail is already verified.";
    }
  } else {
    return redirect('/publisher/login')->with('warning', "Sorry your email cannot be identified.");
  }
  return redirect('/publisher/login')->with('status', $status);
}
}
