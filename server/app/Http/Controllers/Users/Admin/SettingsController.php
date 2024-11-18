<?php
namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use Hash;
use Auth;
class SettingsController extends Controller
{
    public function __construct()
    {
  $this->middleware(['auth:admin','2faadmin']);
    }

    public function index()
    {
        return view('admin.settings');
    }

      public function ChangePassword(Request $request)
    {
        if($request->password!=$request->confirm_password){
            $request->session()->flash('success', 'Password Not Match');
             return redirect()->back()->with('success', 'Password Not Match');
        }
    	$data=array(
    			'password'=> Hash::make($request->password),
    			);
    	DB::table('admins')->where('id',$request->id)->update($data);
       return redirect()->back()->with('success', 'Password Updated  Successfully');
    }

    public function  UpdateSettings(Request $request){

         $imageName='';
          if($request->logo!=''){
  @unlink('site_images/'.$request->hidden_logo);
 $imageName = mt_rand(1,1000).''.time() . '.' . $request->file('logo')->getClientOriginalExtension();
  $request->file('logo')->move('site_images', $imageName);
 }
 else{
        $imageName=$request->hidden_logo;
 }

   $icon='';
          if($request->icon!=''){
  @unlink('site_images/'.$request->hidden_icon);
 $icon = mt_rand(1,1000).''.time() . '.' . $request->file('icon')->getClientOriginalExtension();
  $request->file('icon')->move('site_images', $icon);
 }
 else{
        $icon=$request->hidden_icon;
 }




    	$data=array(
    		'auto_signup'=>$request->auto_signup,
'minimum_withdraw_amount'=>$request->minimum_withdraw_amount,
'payout_percentage'=>$request->payout_percentage,
//'referral_percentage'=>$request->referral_percentage,
//'disable_signup'=>$request->disable_signup,
'default_tracking_domain'=>$request->default_tracking_domain,
'default_smartlink_domain'=>$request->default_smartlink_domain,
'default_affliate_manager'=>$request->affliate_manager,
'affliate_manager_salary_percentage'=>$request->affliate_percentage,
'default_payment_terms' => $request->default_payment_terms,
'logo'=>$imageName,
'icon'=>$icon,
'vpn_check'=>$request->vpn_check,

'smtp_host'=>$request->smtp_host,
'smtp_port'=>$request->smtp_port,
'smtp_user'=>$request->smtp_user,
'smtp_password'=>$request->smtp_password,
'smtp_enc'=>$request->smtp_enc,
'from_email'=>$request->from_email,
'from_name'=>$request->from_name,
'from_security'=>$request->from_security,
'zerobounce_api'=>$request->zerobounce_api,
'zerobounce_check'=>$request->zerobounce_check,
    	);
DB::table('site_settings')->update($data);
 return redirect()->back()->with('success', 'Settings Updated Successfully');
    }
}
