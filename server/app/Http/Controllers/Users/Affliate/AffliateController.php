<?php
namespace App\Http\Controllers\Users\Affliate;
use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Hash;
use DB;
use Mail;
use Auth;
use Illuminate\Support\Facades\Config;

class AffliateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:affliate','2faaffliate']);
    }

    public function index()
    {
        return view('affliate.dashboard');
    }
       public function MailRoom()
    {
        return view('affliate.mail_room');
    }
       public function ManagePublisher()
    {
        return view('affliate.manage_publishers');
    }
  public function ViewMail()
    {
 return view('affliate.view_send_mail');
}
  public function Payment()
    {
 return view('affliate.payment');
}
    public function ViewPublisherMessages(){
      return view('affliate.view_support_message');
    }
public function ShowPendingPublisher(){

  return view('affliate.pending_publishers');
}

public function  SetPostback($id){
      return view('affliate.set_postback')->with('id',$id);
}


    public function UpdatePostback(Request $request){
      $check=DB::table('postback')->where('publisher_id',$request->id)->first();
      if($check!=''){
          DB::table('postback')->where('publisher_id',$request->id)->update(['link'=>$request->postback]);
      }
      else{
        DB::table('postback')->insert(['link'=>$request->postback,'publisher_id'=>$request->id]);

      }
      return redirect()->back()->with('success','Postback Set Successfully');
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
public function GetDetail($id){
      $check=DB::table('publishers')->where('id',$id)->first();

      if($check->affliate_manager_id==Auth::guard('affliate')->id()){
return view('affliate.get_details')->with('id',$id);
      }
      else{
        return 'You are not allowed to see this user';
      }
}

public function ShowRejectedPublisher(){

  return view('affliate.rejected_publisher');
}


       public function Support($reply='')
    {
        return view('affliate.Support')->with('reply',$reply);
    }

   public function ViewMessage($id)
    {
      DB::table('messages')->where('id',$id)->update(['is_read'=>1]);
        return view('affliate.view_message',['id'=>$id]);
    }
public function GenerateLink(){
  return view('affliate.generate_link');
}

  public function SendMessage(Request $request){
            $imagenid='';
      if($request->screenshot!=''){


 $imagenid = mt_rand(1,1000).''.time() . '.' . $request->file('screenshot')->getClientOriginalExtension();
  $request->file('screenshot')->move('screenshot', $imagenid);
      }
foreach ($request->publisher as $p) {
    # code...


        $data=array(
          'sender'=>Auth::guard('affliate')->user()->email,
          'receiver'=>$p,
          'subject'=>$request->subject,
          'message'=>$request->message,
                'screenshot'=>$imagenid,
                'affliate_id'=>Auth::guard('affliate')->id(),
          'is_read'=>0);
        DB::table('messages')->insert($data);
       $pub= DB::table('publishers')->where('email',$p)->first();
            $data=array('message'=>$request->message,'subject'=>$request->subject,'email'=>$p,'name'=>$pub->name);

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

  Mail::send('emails.AdminMessages',['data'=>$data], function($message) use ($data) {
       $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
    $message->to($data ['email'], $data['name'])->subject
            ($data['subject']);







      });
        }
     return redirect()->back()->with('success', 'Message Send Successfully');
      }
public function ViewPendingPublisher(){
  $data=DB::table('publishers as p')->where('affliate_manager_id',Auth::guard('affliate')->id())->where('status','Inactive')->get();
  return response()->json($data);
}

public function ViewRejectedPublisher(){
  $data=DB::table('publishers as p')->where('affliate_manager_id',Auth::guard('affliate')->id())->where('status','Rejected')->orWhere('status','Banned')->get();
  return response()->json($data);
}




       public function SmartlinkApproveRequest(Request $request,$id)
    {
         $id=$id;

        DB::table('smartlinks')->where('id',$id)->update(['enabled'=>'1']);
$ap= DB::table('smartlinks')->where('id',$id)->first();

$publisher=DB::table('publishers')->where('id',$ap->publisher_id)->first();

  $data=array('message'=>'','subject'=>'Your Smartlink  has been Approved','email'=>$publisher->email,'smartlink_name'=>$ap->name,'id'=>$ap->id,'status'=>'Approved','name'=>$publisher->name,'url'=>$ap->url);

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

  Mail::send('emails.approvesmartlinkrequest',['data'=>$data], function($message) use ($data) {
       $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], $data ['name'])->subject
            ($data['subject']);

      });
   return redirect()->back()->with('success', 'Smartlink Approved Successfully');
}



       public function SmartlinkRejectRequest(Request $request,$id)
    {
         $id=$id;

        DB::table('smartlinks')->where('id',$id)->update(['enabled'=>'2']);

        return redirect()->back()->with('success', 'Smartlink Rejected Successfully');
    }

     public function ShowPublisher()
    {

$id=Auth::guard('affliate')->id();
       $data=DB::select("SELECT p.name,p.id,p.publisher_image,p.email,p.created_at,p.status,p.vpn_clicks,(select count(id) from offer_process as o where o.unique_=1 and o.publisher_id=p.id) as unique_clicks,(select count(id) from offer_process where    publisher_id=p.id) as total_clicks,(select count(id) from offer_process where status='Approved' and    publisher_id=p.id) as total_leads,(select sum(publisher_earned) from offer_process where    publisher_id=p.id and status='Approved') as total_earnings FROM publishers as p  where p.status='Active' and p.affliate_manager_id='$id' order by p.id desc");
        return response()->json($data);
    }



    public function ShowSmartlinkRequest(Request $request){

      $id=Auth::guard('affliate')->id();
         $qry=DB::select("select s.id as sid,s.url,s.created_at,s.enabled,s.earnings,c.category_name,s.name as sname,p.name as publisher_name,(select count(id) from offer_process as o where s.key_=o.key_) as total_clicks,(select count(id) from offer_process as o where s.key_=o.key_ and status='Approved') as total_leads,(select count(id) from smartlinks as sm  where sm.publisher_id=s.publisher_id) as total_smartlinks from smartlinks as s join publishers as p on s.publisher_id = p.id join category as c on c.id = s.category_id where p.affliate_manager_id='$id' and enabled=0 order by s.id desc");
    return $qry;
    }
        public function ShowSmartlinkApproveRequest(Request $request){

      $id=Auth::guard('affliate')->id();
         $qry=DB::select("select s.id as sid,s.url,s.created_at,s.enabled,s.earnings,c.category_name,s.name as sname,p.name as publisher_name,(select count(id) from offer_process as o where s.key_=o.key_) as total_clicks,(select count(id) from offer_process as o where s.key_=o.key_ and status='Approved') as total_leads,(select count(id) from smartlinks as sm  where sm.publisher_id=s.publisher_id) as total_smartlinks from smartlinks as s join publishers as p on s.publisher_id = p.id join category as c on c.id = s.category_id where p.affliate_manager_id='$id' and  enabled='1'  order by s.id desc");
    return $qry;
    }

        public function ShowSmartlinkRejectedRequest(Request $request){

      $id=Auth::guard('affliate')->id();
         $qry=DB::select("select s.id as sid,s.url,s.created_at,s.enabled,s.earnings,c.category_name,s.name as sname,p.name as publisher_name,(select count(id) from offer_process as o where s.key_=o.key_) as total_clicks,(select count(id) from offer_process as o where s.key_=o.key_ and status='Approved') as total_leads,(select count(id) from smartlinks as sm  where sm.publisher_id=s.publisher_id) as total_smartlinks from smartlinks as s join publishers as p on s.publisher_id = p.id join category as c on c.id = s.category_id where p.affliate_manager_id='$id' and  enabled='2'  order by s.id desc");
    return $qry;
    }
    public function PendingSmartlink()
{

  return view('affliate.pending_smartlink');
}
 public function ApproveSmartlink()
{

  return view('affliate.approve_smartlink');
}
 public function RejectedSmartlink()
{

  return view('affliate.rejected_smartlink');
}


      public function SendMail(Request $request)
    {
         $message=$request->message;
        $subject=$request->subject;
        $email=$request->email;

        // $qry=DB::table('contact_us')->insert(['name'=>$name,'email'=>$email,'message'=>$message]);
$data=array('message'=>$message,'subject'=>$subject,'email'=>$email,'affliate_id'=>Auth::guard('affliate')->id());

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

  Mail::send('emails.mailroom',['data'=>$data], function($message) use ($data) {
      $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], 'Publisher')->subject
            ($data['subject']);


      });
  DB::table('mail_room')->insert($data);
         return redirect()->back()->with('success', 'Mail Sent Successfully');
    }


      public function BanPublisher(Request $request,$id)
    {
         $id=$id;
    $publisher=DB::table('publishers')->where('id',$id)->first();
  	    DB::table('publishers')->where('id',$id)->update(['status'=>'banned']);
$data=array('message'=>'Your Account has been Banned by '.Auth::guard('affliate')->user()->name.'','subject'=>'Account Ban','publisher_id'=>$publisher->id,'email'=>$publisher->email,'name'=>$publisher->name);


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

  Mail::send('emails.sendmail',['data'=>$data], function($message) use ($data) {
       $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], $data['name'])->subject
            ($data['subject']);


      });
        return redirect()->back()->with('success', 'User Banned Successfully');
             }


      public function ApprovePublisher(Request $request,$id)
    {
         $id=$id;
    $publisher=DB::table('publishers')->where('id',$id)->first();
  	    DB::table('publishers')->where('id',$id)->update(['status'=>'Active']);
$data=array('message'=>'Your Account has been Approved by '.Auth::guard('affliate')->user()->name.'','subject'=>'Account Approved','email'=>$publisher->email,'publisher_id'=>$publisher->id,'name'=>$publisher->name);

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

  Mail::send('emails.sendmail',['data'=>$data], function($message) use ($data) {
      $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], $data['name'])->subject
            ($data['subject']);


      });
        return redirect()->back()->with('success', 'User Approved Successfully');
             }

      public function RejectPublisher(Request $request,$id)
    {
         $id=$id;
    $publisher=DB::table('publishers')->where('id',$id)->first();
  	    DB::table('publishers')->where('id',$id)->update(['status'=>'Rejected']);
$data=array('message'=>'Your Account has been Rejected by '.Auth::guard('affliate')->user()->name.'','subject'=>'Account Rejected','publisher_id'=>$publisher->id,'email'=>$publisher->email,'name'=>$publisher->name);


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

  Mail::send('emails.sendmail',['data'=>$data], function($message) use ($data) {
        $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], $data['name'])->subject
            ($data['subject']);


      });
        return redirect()->back()->with('success', 'User Rejected Successfully');
             }
     public function Settings()
    {
    	$data=DB::table('affliates')->where('id',Auth::guard('affliate')->id())->first();
        return view('affliate.settings',['data'=>$data]);
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
    	DB::table('affliates')->where('id',$request->id)->update($data);
       return redirect()->back()->with('success', 'Password Updated  Successfully');
    }
     public function UpdateSettings(Request $request)
    {
        // dd($request);
         $imageName='';
          if($request->photo!=''){
 @unlink('uploads/'.$request->hidden_img);
 $imageName = mt_rand(1,1000).''.time() . '.' . $request->file('photo')->getClientOriginalExtension();
  $request->file('photo')->move('uploads', $imageName);
 }
 else{
        $imageName=$request->hidden_img;
 }
    	$data=array(
    		  'name'=>$request->name,

                'email'=>$request->email,
                    'skype'=>$request->skype,
                'address'=>$request->address,
                'photo'=>$imageName,
                'payment_description'=>$request->payment_description,
                'payment_method'=>$request->payment_method

    			);
    	DB::table('affliates')->where('id',$request->id)->update($data);
         return redirect()->back()->with('success', 'Settings Updated Successfully');
    }
}
