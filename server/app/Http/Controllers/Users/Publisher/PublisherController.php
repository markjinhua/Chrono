<?php
namespace App\Http\Controllers\Users\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;
use App\Smartlink;
use PDF;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:publisher','2fa']);
    }

    public function index()
    {
        $data['click_count'] = $click_count = DB::table('offer_process')->where('publisher_id', Auth::user()->id)
        ->whereDate('created_at', Carbon::today())
        ->count();

        $data['lead_count'] = $lead_count = DB::table('offer_process')->where('publisher_id', Auth::user()->id)
        ->where('status', 'Approved')
        ->whereDate('created_at', Carbon::today())
        ->count();

        if($click_count != null && $lead_count != null){
            $data['ctr'] = $click_count/$lead_count;
        }else{
            $data['ctr'] = 0;
        }


        $data['payout_count'] = $payout_count = DB::table('offer_process')->where('publisher_id', Auth::user()->id)
        ->where('status', 'Approved')
        ->whereDate('created_at', Carbon::today())
        ->sum('payout');
        if($payout_count != null && $lead_count != null){
            $data['epc'] = $payout_count/$lead_count;
        }else{
            $data['epc'] = 0;
        }

        $data['publisher_table'] = $publisher_table = DB::table('publishers')->where('id', Auth::user()->id)
        ->first();



        $data['today_earning'] = $today_earning = DB::table('offer_process')->where('publisher_id', Auth::user()->id)
        ->where('status', 'Approved')
        ->whereDate('created_at', Carbon::today())
        ->sum('payout');
        if($today_earning != null){
            $site=DB::table('site_settings')->first();

            $data['td_epc'] = ($today_earning/100) * $site->payout_percentage;
        }else{
            $data['td_epc'] = 0;
        }

        return view('publisher.dashboard', $data);
    }

    public function DailyReport()
    {

        return view('publisher.daily_report',['from_date'=>date('Y-m-d 00:00:00'),'to_date'=>date('Y-m-d 23:59:59')]);
    }

    public function ShowDailyReport(Request $request)
    {

        return view('publisher.daily_report',['from_date'=>$request->from_date,'to_date'=>$request->to_date]);
    }
   public function ManageSite()
    {
        return view('publisher.manage_site');
    }
       public function AddSite()
    {
        return view('publisher.add_site');
    }

       public function PaymentPdf()
    {

    $pdf = PDF::loadView('publisher.payment_pdf');

      // download PDF file with download method
return $pdf->stream('report.pdf');

    }


           public function InsertSite(Request $request)
    {


 $validator=Validator::make($request->all(), [
    'url' => 'required',

]);
 if ($validator->fails()) {
  return redirect()->back()
           ->withErrors($validator)
           ->withInput();
}
        $data=array(

    		'url'=>$request->url,
    		'publisher_id'=>Auth::guard('publisher')->id(),
    	 );
        DB::table('smartlink_domain')->insert($data);
            return redirect()->back()->with('success', 'Parking Domain added successfully');
    }
     public function UpdateSite(Request $request)
    {
        $data=array(

    		'url'=>$request->url,
    		  );
        $qry=DB::table('smartlink_domain')->where('id',$request->id)->update($data);
          	return response()->json($qry);
    }

   public function ShowSite()
    {
    	$qry=DB::table('smartlink_domain')->where('publisher_id',null)->Orwhere('publisher_id',Auth::guard('publisher')->id())->get();
    	return response()->json($qry);
    }
      public function DeleteSite(Request $request)
    {
    	$qry=DB::table('smartlink_domain')->where('id',$request->id)->delete();
    	return response()->json($qry);
    }
        public function EditSite(Request $request)
    {
    	$qry=DB::table('smartlink_domain')->where('id',$request->id)->first();
    	return response()->json($qry);
    }



   public function ViewMessage($id)
    {
    	DB::table('messages')->where('id',$id)->update(['is_read'=>1]);
        return view('publisher.view_message',['id'=>$id]);

    }
       public function ViewNotification($id)
    {
        DB::table('notification')->where('id',$id)->update(['is_read'=>1]);
        return view('publisher.view_notification',['id'=>$id]);

    }




 public function InsertSmartlink(Request $request)
    {


 $validator=Validator::make($request->all(), [
    'url' => 'required',
    'category'=>'required',
    'domain'=>'required',
    'name'=>'required',
    'traffic_source'=>'required',
]);
 if ($validator->fails()) {
  return redirect()->back()
           ->withErrors($validator)
           ->withInput();
}
        $data=array(
           'publisher_id'=>Auth::guard('publisher')->id(),
           'url'=>$request->url,
           'category_id'=>$request->category,
           'key_'=>$request->key,
           'enabled'=>1,
           'name'=>$request->name,
           'traffic_source'=>$request->traffic_source,
           'enabled'=>'0',
       );
        DB::table('smartlinks')->insert($data);
            return redirect('publisher/show-smartlink')->with('success', 'Smartlink added successfully ');
    }

public function DeleteSmartlink(Request $request){
    $row = Smartlink::where('id',$request->id)->first();
    $row->is_delete = '1';
    $row->save();
    return 1;
}

public function LoginHistory()
    {

    	$qry=DB::table('login_history')->where('publisher_id',Auth::guard('publisher')->id())->orderBy('id','desc')->get();
    	return view('publisher.login_information',['qry'=>$qry]);
    	}
    	public function Support($reply=''){
    		return view('publisher.support')->with('reply',$reply);
    	}
	public function SendMessage(Request $request){

      $imagenid='';
      if($request->screenshot!=''){


 $imagenid = mt_rand(1,1000).''.time() . '.' . $request->file('screenshot')->getClientOriginalExtension();
  $request->file('screenshot')->move('screenshot', $imagenid);
      }
$receiver='admin';
if($request->affliate_id!=''){
$receiver='affliate';
}


    		$data=array(
    			'sender'=>Auth::guard('publisher')->user()->email,
    			'receiver'=>$receiver,
    			'subject'=>$request->subject,
    			'message'=>$request->message,
                'screenshot'=>$imagenid,
                'affliate_id'=>Auth::guard('publisher')->user()->affliate_manager_id,
    			'is_read'=>0);
    		DB::table('messages')->insert($data);
     return redirect()->back()->with('success', 'Message Send Successfully');
    	}
public function Smartlink(){

    return view('publisher.smartlink');
}

public function FilterSmartlink(Request $request){
    $id=Auth::guard('publisher')->id();
    $from_date=$request->from_date.' 00:00:00';
    $to_date=$request->to_date.' 23:59:59';

    if($request->from_date=='' && $request->to_date=='' && $request->category==''){
        $qry=DB::select("select *, `s`.`id` as `smart_id` from `smartlinks` as `s` left join `category` as `c` on `c`.`id` = `s`.`category_id` where `s`.`publisher_id` = '$id' and  s.name like '%$request->name%'");
    }
    else if($request->from_date=='' && $request->to_date==''){
         $qry=DB::select("select *, `s`.`id` as `smart_id` from `smartlinks` as `s` left join `category` as `c` on `c`.`id` = `s`.`category_id` where `s`.`publisher_id` = '$id' and  s.name like '%$request->name%' and s.category_id=$request->category");
    }
    else if($request->category==''){
        $qry=DB::select("select *, `s`.`id` as `smart_id` from `smartlinks` as `s` left join `category` as `c` on `c`.`id` = `s`.`category_id` where `s`.`publisher_id` = '$id' and s.created_at>='$from_date' and s.created_at<='$to_date' and s.name like '%$request->name%'");
    }
    else{
        $qry=DB::select("select *, `s`.`id` as `smart_id` from `smartlinks` as `s` left join `category` as `c` on `c`.`id` = `s`.`category_id` where `s`.`publisher_id` = '$id' and s.created_at>='$from_date' and s.created_at<='$to_date' and s.name like '%$request->name%' and s.category_id=$request->category ");
    }

return view('publisher.show_smartlink',['qry'=>$qry]);
}
public function ViewSmartlink(){

         $qry=DB::table('smartlinks as s')->select('*','s.id as smart_id')->where('s.publisher_id',Auth::guard('publisher')->id())->leftjoin('category as c','c.id','=','s.category_id')->get();

    return view('publisher.show_smartlink',['qry'=>$qry]);
}

public function ClicksGraph(){
$today_date=date('Y-m-d 00:00:00');
$id=Auth::guard('publisher')->id();
$qry=DB::select("SELECT (select count(id) from offer_process where publisher_id='$id' and unique_=1  and created_at>='$today_date') as unique_clicks,(select count(id) from offer_process where publisher_id='$id' and created_at>='$today_date') as today_clicks,(select count(id) from offer_process where publisher_id='$id' and status='Approved' and created_at>='$today_date') as today_leads,( SELECT sum(amount) FROM `publisher_transactions` WHERE offer_process_id is not null and publisher_id='$id' and created_at>='$today_date') as total_earnings FROM offer_process where publisher_id='$id' GROUP by publisher_id");

 return $qry;
}


public function Reports(Request $request){




return view('publisher.Report')->with(['from_date'=>$request->from_date.' 00:00:00','to_date'=>$request->to_date.' 23:59:59','type'=>$request->type,'key'=>$request->key]);
}
}
