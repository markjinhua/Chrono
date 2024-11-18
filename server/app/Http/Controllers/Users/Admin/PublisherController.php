<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Support\Google2FAAuthenticator;

use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Publisher;
use App\SiteSetting;
use Illuminate\Support\Facades\Config;
use Mail;

class PublisherController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth:admin','2faadmin']);
    }



       public function ManagePublisher()
    {
        return view('admin.Manage_Publisher');
    }
          public function ShowPublisher()
    {
      $data=DB::select("SELECT p.name,p.id,p.email,p.created_at,p.status,p.vpn_clicks,(select count(id) from offer_process as o where o.unique_=1 and o.publisher_id=p.id) as unique_clicks,(select count(id) from offer_process where    publisher_id=p.id) as total_clicks,(select count(id) from offer_process where status='Approved' and    publisher_id=p.id) as total_leads,(select sum(payout) from offer_process where    publisher_id=p.id and status='Approved') as total_earnings FROM publishers as p order by p.id desc");

        return response()->json($data);
    }
       public function ViewPublisher($id){
        return view('admin.edit_publisher')->with('id',$id);
       }

          public function EditPublisher(Request $request)
    {

    	$data=DB::table('publishers  as c')->where('c.id',$request->id)->first();
        return response()->json($data);
    }
      public function DeletePublisher(Request $request)
    {
    	$data=DB::table('publishers')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertPublisher(Request $request)
    {

        $site=DB::table('site_settings')->first();

        if($request->password!=$request->confirm_password){
            $request->session()->flash('success', 'Password Not Match');
             return redirect()->back()->with('success', 'Password Not Match');
        }
        $photo='';
          if($request->photo!=''){

 $photo = mt_rand(1,1000).''.time() . '.' . $request->file('photo')->getClientOriginalExtension();
  $request->file('photo')->move('uploads', $photo);
 }
    $publisher_last = Publisher::orderBy('id', 'desc')->first();

    	$data=array(
    			'name'=>$request->name,
    			'password'=> Hash::make($request->password),
    			'email'=>$request->email,
    				'country'=>$request->countries,
    			'address'=>$request->address,
                'city'=>$request->city,
                'region'=>$request->region,
                'status'=>$request->status,
                'affliate_manager_id'=>$request->affliate_manager,
                'publisher_image'=>$photo,
                'role' => 'publisher',
                'verified' => '1',
                'expert_mode' => '1',
                'payment_terms'=>$request->default_payment_terms,
                'master_key' => (rand(10000, 99999).$publisher_last->id). +1,
                'password_show' => $request->password,
    			);
    	DB::table('publishers')->insert($data);
       return redirect()->back()->with('success', 'Publisher Created Successfully');
    }

      public function BanPublisher(Request $request,$id)
    {
         $id=$id;
    $publisher=DB::table('publishers')->where('id',$id)->first();
        DB::table('publishers')->where('id',$id)->update(['status'=>'banned']);
$data=array('message'=>'Your Account has been Banned by Admin','subject'=>'Account Banned','email'=>$publisher->email,'name'=>$publisher->name);

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

  Mail::send('emails.sendmailadmin',['data'=>$data], function($message) use ($data) {
       $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], $data['name'])->subject
            ($data['subject']);


      });
        return redirect()->back()->with('success', 'User Banned Successfully');
             }




      public function UpdatePublisher(Request $request)
    {
    $imageName='';
          if($request->photo1!=''){
  @unlink('uploads/'.$request->hidden_img);
 $imageName = mt_rand(1,1000).''.time() . '.' . $request->file('photo1')->getClientOriginalExtension();
  $request->file('photo1')->move('uploads', $imageName);
 }
 else{
        $imageName=$request->hidden_img;
 }

            $imagenid='';
      if($request->nid!=''){


 $imagenid = mt_rand(1,1000).''.time() . '.' . $request->file('nid')->getClientOriginalExtension();
  $request->file('nid')->move('uploads', $imagenid);
      }
      else{
        $imagenid=$request->hidden_nid;
      }
           $imagetax='';
      if($request->nid!=''){


 $imagetax = mt_rand(1,1000).''.time() . '.' . $request->file('tax_file')->getClientOriginalExtension();
  $request->file('tax_file')->move('uploads', $imagetax);
      }
      else{
        $imagetax=$request->hidden_tax;
      }

      $data=array(
'name'=>$request->name,
'phone_code'=>$request->phone_code,
'phone'=>$request->phone,
'address'=>$request->address,
'region'=>$request->region,
'city'=>$request->city,
'postal_code'=>$request->zip,
'skype'=>$request->skype,
'website_url'=>$request->website_url,
'monthly_traffic'=>$request->monthly_traffic,
'category'=>$request->category,
'nid'=>$imagenid,
'additional_information'=>$request->additional_information,
'tax_file'=>$imagetax,
'status'=>$request->status,
                'email'=>$request->email,
                    'country'=>$request->countries,
   'affliate_manager_id'=>$request->affliate_manager,
                    'publisher_image'=>$imageName
);

    	DB::table('publishers')->where('id',$request->id)->update($data);
         return redirect()->back()->with('success', 'Publisher Updated Successfully');
    }

 public function login(Request $request,$email)
    {


$user=Publisher::where('email',$email)->first();

Auth::guard('publisher')->login($user);
        // Attempt to log the user in
          $authenticator = app(Google2FAAuthenticator::class)->boot($request);

    $authenticator->login();
            return redirect('publisher');

        // return redirect()->back()->with('success', 'Error Occured');
    }
}
