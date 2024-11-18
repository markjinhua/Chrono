<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use DB;
use Mail;
use Auth;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin','2faadmin']);
    }

    public function index()
    {
        return view('admin.dashboard')->with(['from_date'=>date('Y-m-d 00:00:00'),'to_date'=>date('Y-m-d 23:59:59')]);
    }

   public function FilterDashboard(Request $request)
    {
        return view('admin.dashboard')->with(['from_date'=>$request->from_date,'to_date'=>$request->to_date]);

    }


        public function ManageDomain()
    {
        return view('admin.Manage_Domain');
    }
          public function ShowDomain()
    {
    	$data=DB::table('domain')->where('is_deleted',0)->get();
        return response()->json($data);
    }
          public function EditDomain(Request $request)
    {
    	$data=DB::table('domain')->where('id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteDomain(Request $request)
    {
    	$data=DB::table('domain')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertDomain(Request $request)
    {
    	$data=array(
    			'domain_name'=>$request->domain_name,
    			);
    	DB::table('domain')->insert($data);
        return response()->json(['success'=>'Data Inserted ']);
    }
      public function UpdateDomain(Request $request)
    {
    	$data=array(
    			'domain_name'=>$request->domain_name1,
    			);
    	DB::table('domain')->where('id',$request->id)->update($data);
        return response()->json(['success'=>'Data Inserted ']);
    }










public function ShowSmartlinkRequest()
    {

      $qry=DB::select("select s.id as sid,s.url,s.created_at,s.enabled,s.earnings,c.category_name,s.name as sname,p.name as publisher_name,(select count(id) from offer_process as o where s.key_=o.key_) as total_clicks,(select count(id) from offer_process as o where s.key_=o.key_ and status='Approved') as total_leads,(select count(id) from smartlinks as sm  where sm.publisher_id=s.publisher_id) as total_smartlinks from smartlinks as s join publishers as p on s.publisher_id = p.id join category as c on c.id = s.category_id order by s.id desc");
    return $qry;
    }


public function ManageSmartlinkDomain()
    {
        return view('admin.Manage_Smartlink_Domain');
    }
    public function ManageSmartlinkRequest()
    {
        return view('admin.Manage_Smartlink_Request');
    }

          public function ShowSmartlinkDomain()
    {
        $data=DB::table('smartlink_domain')->get();
        return response()->json($data);
    }
          public function EditSmartlinkDomain(Request $request)
    {
        $data=DB::table('smartlink_domain')->where('id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteSmartlinkDomain(Request $request)
    {
        $data=DB::table('smartlink_domain')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertSmartlinkDomain(Request $request)
    {
        $data=array(
                'url'=>$request->domain_name,
                );
        DB::table('smartlink_domain')->insert($data);
        return response()->json(['success'=>'Data Inserted ']);
    }
      public function UpdateSmartlinkDomain(Request $request)
    {
        $data=array(
                'url'=>$request->domain_name1,
                );
        DB::table('smartlink_domain')->where('id',$request->id)->update($data);
        return response()->json(['success'=>'Data Inserted ']);
    }









     public function ManageCategory()
    {
        return view('admin.Manage_Categories');
    }
          public function ShowCategory()
    {
    	$data=DB::table('category')->where('is_deleted',0)->get();
        return response()->json($data);
    }
          public function EditCategory(Request $request)
    {
    	$data=DB::table('category')->where('id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteCategory(Request $request)
    {
    	$data=DB::table('category')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertCategory(Request $request)
    {
    	$data=array(
    			'category_name'=>$request->Categories_name,
    			);
    	DB::table('category')->insert($data);
        return response()->json(['success'=>'Data Inserted ']);
    }
      public function UpdateCategory(Request $request)
    {
    	$data=array(
    			'category_name'=>$request->Categories_name1,
    			);
    	DB::table('category')->where('id',$request->id)->update($data);
        return response()->json(['success'=>'Data Inserted ']);
    }












     public function ManageSiteCategory()
    {
        return view('admin.Manage_Site_Categories');
    }
          public function ShowSiteCategory()
    {
        $data=DB::table('site_category')->get();
        return response()->json($data);
    }
          public function EditSiteCategory(Request $request)
    {
        $data=DB::table('site_category')->where('id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteSiteCategory(Request $request)
    {
        $data=DB::table('site_category')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertSiteCategory(Request $request)
    {
        $data=array(
                'site_category_name'=>$request->Categories_name,
                );
        DB::table('site_category')->insert($data);
        return response()->json(['success'=>'Data Inserted ']);
    }
      public function UpdateSiteCategory(Request $request)
    {
        $data=array(
                'site_category_name'=>$request->Categories_name1,
                );
        DB::table('site_category')->where('id',$request->id)->update($data);
        return response()->json(['success'=>'Data Inserted ']);
    }

















     public function ManageBanIp()
    {
        return view('admin.Manage_Ban_Ip');
    }
          public function ShowBanIp()
    {
    	$data=DB::table('ban_ip')->get();
        return response()->json($data);
    }
          public function EditBanIp(Request $request)
    {
    	$data=DB::table('ban_ip')->where('id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteBanIp(Request $request)
    {
    	$data=DB::table('ban_ip')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertBanIp(Request $request)
    {
    	$data=array(
    			'ip_address'=>$request->ip_address,
    			);
    	DB::table('ban_ip')->insert($data);
        return response()->json(['success'=>'Data Inserted ']);
    }
      public function UpdateBanIp(Request $request)
    {
    	$data=array(
    			'ip_address'=>$request->ip_address1,
    			);
    	DB::table('ban_ip')->where('id',$request->id)->update($data);
        return response()->json(['success'=>'Data Inserted ']);
    }



public function WebsiteApprovalRequest(){
	return view('admin.WebsiteApprovalRequest');
}



  public function PublisherApproveRequest(Request $request,$id)
    {
         $id=$id;
    $publisher=DB::table('publishers')->where('id',$id)->first();
        DB::table('publishers')->where('id',$id)->update(['status'=>'Active']);
$data=array('message'=>'Your Account has been Approved by Admin','subject'=>'Account Approved','email'=>$publisher->email,'publisher_id'=>$publisher->id,'name'=>$publisher->name);

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
        return redirect()->back()->with('success', 'User Approved Successfully');
             }


public function PublisherApprovalRequest(){
	return view('admin.PublisherApprovalRequest');
}

public function ShowPublisherApproval(){
$qry=DB::table('publishers as s')->where('s.status','Inactive')->orderBy('s.id','desc')->get();
	return response()->json($qry);

}
public function ShowWebsiteApproval(){
$qry=DB::table('site as s')->select('p.name as publisher_name','s.name','s.url','s.id','s.description','s.status')->join('publishers as p','p.id','=','s.publisher_id')->orderBy('s.id','desc')->get();
	return response()->json($qry);

}
  public function WebsiteApproveRequest(Request $request,$id)
    {
         $id=$id;

        DB::table('site')->where('id',$id)->update(['status'=>'Approved']);

        return redirect()->back()->with('success', 'Site Approved Successfully');
    }

       public function WebsiteRejectRequest(Request $request,$id)
    {
         $id=$id;

        DB::table('site')->where('id',$id)->update(['status'=>'Rejected']);

        return redirect()->back()->with('success', 'Site Rejected Successfully');
    }


       public function Messages($reply='')
    {
        return view('admin.Messages')->with('reply',$reply);
    }

   public function ViewMessage($id)
    {
    	DB::table('messages')->where('id',$id)->update(['is_read'=>1]);
        return view('admin.view_message',['id'=>$id]);
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
    			'sender'=>'admin',
    			'receiver'=>$p,
    			'subject'=>$request->subject,
    			'message'=>$request->message,
                'screenshot'=>$imagenid,
    			'is_read'=>0);
    		DB::table('messages')->insert($data);
    		$pub=DB::table('publishers')->where('email',$p)->first();
            $data=array('message'=>$request->message,'subject'=>$request->subject,'email'=>$p,'name'=>$pub->name);

            try {

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

              } catch (\Exception $e) {

              }

        }
     return redirect()->back()->with('success', 'Message Send Successfully');
    	}

       public function ManageNews()
    {
        return view('admin.Manage_News');
    }
          public function ShowNews()
    {
    	$data=DB::table('news_and_announcement')->orderBy('id','desc')->get();
        return response()->json($data);
    }
          public function EditNews(Request $request)
    {
    	$data=DB::table('news_and_announcement')->where('id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteNews(Request $request)
    {
    	$data=DB::table('news_and_announcement')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertNews(Request $request)
    {
    	$data=array(
    			'title'=>$request->title,
    			'description'=>$request->description,
    			);
    	DB::table('news_and_announcement')->insert($data);
        $id=DB::getPdo()->lastInsertId();
$pub=DB::table('publishers')->get();
foreach($pub as $p){
        $data=array(
            'news_id'=>$id,
            'publisher_id'=>$p->id,
            'is_read'=>0
        );
        DB::table('notification')->insert($data);
    }
        return response()->json(['success'=>'Data Inserted ']);
    }
      public function UpdateNews(Request $request)
    {
    	$data=array(
    		'title'=>$request->title1,
    			'description'=>$request->description1,
    			);
    	DB::table('news_and_announcement')->where('id',$request->id)->update($data);
        return response()->json(['success'=>'Data Inserted ']);
    }


}
