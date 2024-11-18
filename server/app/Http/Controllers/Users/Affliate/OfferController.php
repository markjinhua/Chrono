<?php
namespace App\Http\Controllers\Users\Affliate;

use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use DB;
use Mail;
use Auth;
use Illuminate\Support\Facades\Config;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:affliate','2faaffliate']);
    }


        public function PendingOfferProcess()
    {
        return view('affliate.pending_offer_process');
    }
    public function WaitOfferProcess()
    {
        return view('affliate.wait_offer_process');
    }
        public function RejectOfferProcess()
    {
        return view('affliate.rejected_offer_process');
    }
    public function ApproveOfferProcess()
    {
        return view('affliate.approve_offer_process');
    }
       public function ApprovalRequest()
    {
        return view('affliate.approval_request');
    }
           public function ApproveApprovalRequest()
    {
        return view('affliate.approve_approval_request');
    }

    public function viewOfferDetail()
    {
        return view('affliate.view_offer_details');
    }

    public function offerDetail(Request $req)
    {
        $site=DB::table('site_settings')->first();
        $qry=DB::table('offers as o')->select('*','o.id as oid')->leftjoin('category as c','c.id','=','o.category_id')->where('o.id',$req->offer_id)->where('o.status','Active')->first();
        // dd($qry);
        if(is_null($qry)) {
            return redirect()->back()->with('danger', 'There is no such Offer Exists!');
        }
        return view('affliate.offer_detail', get_defined_vars());
    }



       public function ApproveRequest(Request $request,$id)
    {
         $id=$id;

        DB::table('approval_request')->where('id',$id)->update(['approval_status'=>'Approved']);
$ap= DB::table('approval_request')->where('id',$id)->first();
$offer=DB::table('offers')->where('id',$ap->offer_id)->first();
$publisher=DB::table('publishers')->where('id',$ap->publisher_id)->first();

  $data=array('message'=>'','subject'=>'Your Offer Request No '.$id.' has been Approved','email'=>$publisher->email,'payout'=>$offer->payout,'offer_name'=>$offer->offer_name,'offer_id'=>$offer->id,'status'=>'Approved','name'=>$publisher->name);


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

  Mail::send('emails.approveofferrequest',['data'=>$data], function($message) use ($data) {
       $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
 $message->to($data ['email'], $data ['name'])->subject
            ($data['subject']);

      });
        return redirect()->back()->with('success', 'Offer Approved Successfully');
    }

 public function RejectRequest(Request $request,$id)
    {
         $id=$id;

        DB::table('approval_request')->where('id',$id)->update(['approval_status'=>'Rejected']);

        return redirect()->back()->with('success', 'Offer Rejected Successfully');
    }


     public function ShowApprovalRequest()
    {

$id=Auth::guard('affliate')->id();
    $qry= DB::select("SELECT a.id,o.offer_name,a.approval_status,p.name,a.created_at,a.description,(select count(id) from offer_process where publisher_id=p.id and offer_id=o.id) as total_clicks,(select count(id) from offer_process where publisher_id=p.id and offer_id=o.id and offer_process.status='Approved') as total_leads  FROM `approval_request`  as a   join offers as o on o.id=a.offer_id  and (a.approval_status='Pending' or a.approval_status='Requested') join publishers as p on p.id=a.publisher_id and p.affliate_manager_id='$id'   order by a.id desc");
    return response()->json($qry);
    }

     public function ShowApprovalRequestApproved()
    {
          $id=Auth::guard('affliate')->id();

    $qry= DB::select("SELECT a.id,o.offer_name,a.approval_status,p.name,a.created_at,a.description,(select count(id) from offer_process where publisher_id=p.id and offer_id=o.id) as total_clicks,(select count(id) from offer_process where publisher_id=p.id and offer_id=o.id and offer_process.status='Approved') as total_leads  FROM `approval_request`  as a   join offers as o on o.id=a.offer_id  join publishers as p on p.id=a.publisher_id   and (a.approval_status='Approved' )  and p.affliate_manager_id='$id'  order by a.id desc");
    return response()->json($qry);
    }

  public function DeleteApprovalRequest(Request $request)
    {
          $qry=DB::table('approval_request')->where('id',$request->id)->delete();
   return response()->json($qry);
    }



public function SearchPendingOfferProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
 $id=Auth::guard('affliate')->id();

$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Pending' and p.affliate_manager_id='$id' and of.offer_type='private' and o.key_ is null and aff.power_mode=1  $countries  $ua $browser order by o.id desc ");

return $qry;

}


public function SearchRejectOfferProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }

$id=Auth::guard('affliate')->id();

$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Rejected' and p.affliate_manager_id='$id'  and o.key_ is null and aff.power_mode=1    $countries  $ua $browser order by o.id desc ");

return $qry;

}

public function SearchWaitOfferProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }

$id=Auth::guard('affliate')->id();

$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Awaited' and p.affliate_manager_id='$id'   and o.key_ is null and aff.power_mode=1    $countries  $ua $browser order by o.id desc ");

return $qry;

}
public function SearchApproveOfferProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }

$id=Auth::guard('affliate')->id();
$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Approved' and p.affliate_manager_id='$id'   and o.key_ is null  and aff.power_mode=1   $countries  $ua $browser order by o.id desc ");

return $qry;

}






















public function SearchPendingSmartlinkProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }

$id=Auth::guard('affliate')->id();

$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Pending'    and o.key_ is not null  $countries  $ua $browser order by o.id desc ");

return $qry;

}


public function SearchRejectedSmartlinkProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }

$id=Auth::guard('affliate')->id();

$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Rejected'   and p.affliate_manager_id='$id' and aff.power_mode=1  and o.key_ is not null   $countries  $ua $browser order by o.id desc ");

return $qry;

}

public function SearchWaitSmartlinkProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }

$id=Auth::guard('affliate')->id();

$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Awaited'  and p.affliate_manager_id='$id' and aff.power_mode=1  and o.key_ is not null   $countries  $ua $browser order by o.id desc ");

return $qry;

}
public function SearchApprovedSmartlinkProcess(Request $request){


     $count=0;
     $countries='';
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
            $countries='and  country like \'%'.$c.'%\' ';
         }
         else{
                $countries.=' or country like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
         $ua='';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
            $ua='and ua_target like \'%'.$c.'%\' ';
         }
         else{
                $ua.=' or ua_target like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }
             $browser='';
    $count=0;
    if(isset($request->browsers)){
    foreach ($request->browsers as $c) {
if($count==0){
            $browser='and browser like \'%'.$c.'%\' ';
         }
         else{
                $browser.=' or browser like \'%'.$c.'%\' ';
         }
         $count++;
         }
        }


$id=Auth::guard('affliate')->id();
$qry=DB::select("select `o`.`offer_name`,o.id, `o`.`advertiser_offer_id`, `o`.`ip_address`, `o`.`created_at`, `o`.`publisher_id`, `p`.`name` as `publisher_name`, `p`.`email` as `publisher_email`, `o`.`payout`, `a`.`advertiser_name`, `o`.`code`, `o`.`country`, `o`.`browser`, `o`.`ua_target`, `o`.`unique_`, `o`.`status` from `offer_process` as `o` inner join `publishers` as `p` on `p`.`id` = `o`.`publisher_id` join affliates as aff on aff.id=p.affliate_manager_id join offers as of on of.id=o.offer_id inner join `advertisers` as `a` on `a`.`id` = `o`.`advertiser_id` where `o`.`offer_name` like '%$request->offer_name%' and `o`.`offer_id` like '%$request->offer_id%' and `o`.`ip_address` like '%$request->ip_address%' and `p`.`name` like '%$request->publisher_name%' and `p`.`email` like '%$request->publisher_email%' and `o`.`code` like '%$request->hash%' and `a`.`advertiser_name` like '%$request->advertiser_name%' and o.status='Approved' and p.affliate_manager_id='$id'    and aff.power_mode=1   and o.key_ is  not null  $countries  $ua $browser order by o.id desc ");

return $qry;

}

























           public function ApprovePendingOfferProcess(Request $request)
    {

    $site=DB::table('site_settings')->first();



        foreach($request->check as $c){


            $qry=DB::table('offer_process')->where('id',$c)->first();

if($qry->status=='Approved'){

    return 1;
}
else{
    DB::table('offer_process')->where('id',$c)->update(['status'=>'Approved']);

            $offer=DB::table('offers')->where('id',$qry->offer_id)->first();
            $publisher=DB::table('publishers')->where('id',$qry->publisher_id)->first();
              $publisher_earnings=$qry->payout*$offer->payout_percentage/100;
            DB::table('publishers')->where('id',$qry->publisher_id)->increment('balance',$publisher_earnings);
                 DB::table('publishers')->where('id',$qry->publisher_id)->increment('total_earnings',$publisher_earnings);
                 DB::table('offers')->where('id',$qry->offer_id)->increment('leads',1);
                    if($qry->key_!=null){
                 DB::table('smartlinks')->where('key_',$qry->key_)->increment('earnings',$publisher_earnings);
             }

$data=array(
'offer_process_id'=>$qry->id,
'amount'=>$publisher_earnings,
'publisher_id'=>$qry->publisher_id);
DB::table('publisher_transactions')->insert($data);


$pub=DB::table('publishers')->where('id',$qry->publisher_id)->first();

if($pub->affliate_manager_id!=''){

            $affliate_earning=($qry->payout*$site->affliate_manager_salary_percentage/100);
$data1=array(
'offer_process_id'=>$qry->id,
'amount'=>$affliate_earning,
'affliate_id'=>$pub->affliate_manager_id);
DB::table('affliate_transactions')->insert($data1);
         DB::table('affliates')->where('id',$pub->affliate_manager_id)->increment('balance',$affliate_earning);
                 DB::table('affliates')->where('id',$pub->affliate_manager_id)->increment('total_earnings',$affliate_earning);
}


    $data=array(
        'publisher_id'=>$qry->publisher_id,
        'earnings'=>$publisher_earnings,
        'lead'=>1,
    );
    DB::table('ranking')->insert($data);
    $data=array('message'=>'','subject'=>'Your Offer Process No '.$c.' has been Approved','email'=>$publisher->email,'hash'=>$qry->code,'payout'=>$qry->payout,'offer_name'=>$qry->offer_name,'ip_address'=>$qry->ip_address,'offer_id'=>$qry->offer_id,'status'=>'Approved','country'=>$qry->country,'device'=>$qry->ua_target,'name'=>$publisher->name);
      $postback=DB::table('postback')->where('publisher_id',$qry->publisher_id)->first();

if($postback!=null){
 $offer_id=$qry->offer_id;
  $offer_name=$qry->offer_name;
 $status='1';
 $payout=$qry->payout;
 $code=$qry->code;
 $sid=$qry->sid;
 $sid2=$qry->sid2;
 $sid3=$qry->sid3;
$sid4=$qry->sid4;
$sid5=$qry->sid5;
$ip=$qry->ip_address;
$browser=$qry->browser;
$ua_target=$qry->ua_target;
$url='';

 $url=$postback->link;
  $url=str_replace("{offer_id}", $offer_id, $url);
    $url=str_replace("{status}", $status, $url);
    $url= str_replace("{code}", $code, $url);
     $url= str_replace("{payout}", $payout, $url);
      $url= str_replace("{sid}", $sid, $url);
       $url= str_replace("{sid2}", $sid2, $url);
       $url=  str_replace("{sid3}", $sid3, $url);
        $url=  str_replace("{sid4}", $sid4, $url);
         $url=  str_replace("{sid5}", $sid5, $url);
         $url=   str_replace("{ip_address}", $ip, $url);
           $url=   str_replace("{offer_name}", $offer_name, $url);
                 $url=   str_replace("{ua_target}", $ua_target, $url);
           $url=     str_replace("{browser}", $browser, $url);

    $timeout=5;
$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        curl_setopt($ch, CURLOPT_URL, $url);
        $response=curl_exec($ch);

        curl_close($ch);


DB::table('postback_sent')->insert(
    ['publisher_id'=>$qry->publisher_id,
    'status'=>'Approved',
    'payout'=>$qry->payout,
    'offer_id'=>$qry->offer_id,
    'url'=>$url,
        ]
);
}

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

   Mail::send('emails.approveofferprocess',['data'=>$data], function($message) use ($data) {
        $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
  $message->to($data ['email'], $data ['name'])->subject
             ($data['subject']);

       });
      }

     }    return 1;

         }
           public function ApproveRejectOfferProcess(Request $request)
    {

      $site=DB::table('site_settings')->first();
        foreach($request->check as $c){
            $qry=DB::table('offer_process')->where('id',$c)->first();
 DB::table('offer_process')->where('id',$c)->update(['status'=>'Rejected']);

if($qry->status=='Rejected'){

    return 1;
}
else{


                         $offer=DB::table('offers')->where('id',$qry->offer_id)->first();
            $publisher=DB::table('publishers')->where('id',$qry->publisher_id)->first();
              $publisher_earnings=$qry->payout*$offer->payout_percentage/100;
            DB::table('publishers')->where('id',$qry->publisher_id)->decrement('balance',$publisher_earnings);
               DB::table('publishers')->where('id',$qry->publisher_id)->decrement('total_earnings',$publisher_earnings);
                DB::table('offers')->where('id',$qry->offer_id)->decrement('leads',1);



//THIS IS FOR POSTBACK

  $postback=DB::table('postback')->where('publisher_id',$qry->publisher_id)->first();
  if($postback!=null){
$offer_id=$qry->offer_id;
  $offer_name=$qry->offer_name;
 $status='2';
 $payout=$qry->payout;
 $code=$qry->code;
 $sid=$qry->sid;
 $sid2=$qry->sid2;
 $sid3=$qry->sid3;
$sid4=$qry->sid4;
$sid5=$qry->sid5;
$ip=$qry->ip_address;
$browser=$qry->browser;
$ua_target=$qry->ua_target;
$url='';

 $url=$postback->link;
  $url=str_replace("{offer_id}", $offer_id, $url);
    $url=str_replace("{status}", $status, $url);
    $url= str_replace("{code}", $code, $url);
     $url= str_replace("{payout}", $payout, $url);
      $url= str_replace("{sid}", $sid, $url);
       $url= str_replace("{sid2}", $sid2, $url);
       $url=  str_replace("{sid3}", $sid3, $url);
        $url=  str_replace("{sid4}", $sid4, $url);
         $url=  str_replace("{sid5}", $sid5, $url);
         $url=   str_replace("{ip_address}", $ip, $url);
           $url=   str_replace("{offer_name}", $offer_name, $url);
                 $url=   str_replace("{ua_target}", $ua_target, $url);
           $url=     str_replace("{browser}", $browser, $url);

    $timeout=5;
$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        curl_setopt($ch, CURLOPT_URL, $url);
        $response=curl_exec($ch);

        curl_close($ch);


DB::table('postback_sent')->insert(
    ['publisher_id'=>$qry->publisher_id,
    'status'=>'Rejected',
    'payout'=>$qry->payout,
    'offer_id'=>$qry->offer_id,
    'url'=>$url,
        ]
);
}
//END POSTBACK LOGIN


//START SMARLINK LOGIC
 if($qry->key_!=null){
         DB::table('smartlinks')->where('key_',$qry->key_)->decrement('earnings',$qry->payout);
  }
  //END SMARTLINK LOGIN


  //GOING TO PUBLISHER TRANSACTION TABLE
$data=array(
'offer_process_id'=>$qry->id,
'amount'=>-1*$publisher_earnings,
'publisher_id'=>$qry->publisher_id);
DB::table('publisher_transactions')->insert($data);
$pub=DB::table('publishers')->where('id',$qry->publisher_id)->first();
//END PUB TABLE


//GOING TO AFFLIATE TRANSACTION TABLE
if($pub->affliate_manager_id!=''){

            $affliate_earning=($qry->payout*$site->affliate_manager_salary_percentage/100);
$data1=array(
'offer_process_id'=>$qry->id,
'amount'=>-1*$affliate_earning,

'affliate_id'=>$pub->affliate_manager_id);
DB::table('affliate_transactions')->insert($data1);

  DB::table('affliates')->where('id',$pub->affliate_manager_id)->decrement('balance',$affliate_earning);
                 DB::table('affliates')->where('id',$pub->affliate_manager_id)->decrement('total_earnings',$affliate_earning);

}
//END GOUNG


//GOING TO RANKING TABLE
    $data=array(
        'publisher_id'=>$qry->publisher_id,
        'earnings'=>-1*$publisher_earnings,
        'lead'=>-1);
    DB::table('ranking')->insert($data);

}
//NOT GOING
}
 return 1;

         }
           public function ApproveRejectOfferProcess1(Request $request)
    {
        DB::table('offer_process')->whereIn('id',$request->check)->update(['status'=>'Rejected']);

 return 1;

         }
           public function ApproveWaitOfferProcess(Request $request)
    {
        DB::table('offer_process')->whereIn('id',$request->check)->update(['status'=>'Awaited']);
         return 1;

         }


         public function ShowOffer()

    {


    $qry= DB::select('SELECT o.offer_name,o.offer_type,o.browsers,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.incentive_allowed,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name,o.smartlink,o.magiclink,o.native,o.lockers,o.id as offerid FROM `offers`  as o    left join category as c on c.id=o.category_id  order by o.id desc');
    return response()->json($qry);
    }
     public function SearchOffer(Request $request)
    {
    $countries='1=1';
    $count=0;
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
    	 	$countries=' countries like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$countries.=' or countries like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	 $ua='1=1';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
    	 	$ua=' ua_target like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$ua.=' or ua_target like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	$traffic='1=1';
    	$count=0;
 if(isset($request->traffic)){
    foreach ($request->traffic as $c) {
if($count==0){
    	 	$traffic=' '.$c.'=1 ';
    	 }
    	 else{
    	 		$traffic.=' and '.$c.'=1';
    	 }
    	 $count++;
    	 }
    	}
    $qry= DB::select("SELECT o.offer_name,o.offer_type,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o  left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%') and (o.status like '$request->status%') and (o.offer_type like '$request->offer_type%') and  ($traffic)  and ($countries) and  ($ua)   order by o.id desc");
    return response()->json($qry);
    }


       public function InsertOffer(Request $request)
    {
    	$imageName='';
    	$icon_url='';

    	  if($request->preview_link!=''){

 $imageName = mt_rand(1,1000).''.time() . '.' . $request->file('preview_link')->getClientOriginalExtension();
  $request->file('preview_link')->move('uploads', $imageName);
 }

  if($request->icon_url!=''){

 $icon_url = mt_rand(1,1000).''.time() . '.' . $request->file('icon_url')->getClientOriginalExtension();
  $request->file('icon_url')->move('uploads', $icon_url);
 }


 $site=DB::table('site_settings')->first();
 if($request->payout_percentage==''){
$percentage=$site->payout_percentage;
 }else{
    $percentage=$request->payout_percentage;
 }


        $data=array(
        	'offer_name'=>$request->offer_name,
        	'advertiser_id'=>$request->advertiser_id,
        	'offer_type'=>$request->offer_type,
        	'advertiser_officer_id'=>$request->advertiser_offer_id,
        	'verticals'=>$request->verticals,
        	'tracking_domain_id'=>$request->tracking_domain_id,
        	'category_id'=>$request->category_id,
        	'description'=>$request->description,
        	'requirements'=>$request->requirements,
        	'link'=>$request->link,
        	'preview_url'=>$imageName,
            'preview_link'=>$request->preview_link,
            'payout_percentage'=>$percentage,
        	'icon_url'=>$icon_url,
        	'lead_qty'=>$request->lead_qty,
        	'payout'=>$request->payout_amount,
        	'countries'=>implode($request->countries,'|'),
        	'ua_target'=>implode($request->ua_target,'|'),
        	'browsers'=>implode($request->browser,'|'),
        'status'=>$request->status,

        	'conversion'=>$request->conversion,
        	'featured_offer'=>$request->featured==null?0:1,
        	'incentive_allowed'=>$request->incentive==null?0:1,
        	'smartlink'=>$request->smartlink==null?0:1,
        	'magiclink'=>$request->magiclink==null?0:1,
        	'lockers'=>$request->lockers==null?0:1,
        	'native'=>$request->native==null?0:1,
        	'payout_type'=>$request->payout,
            'leads'=>0,
            'clicks'=>0
        );
    DB::table('offers')->insert($data);
    $id=DB::getPdo()->lastInsertId();
    if($request->offer_type=='special'){
   foreach ($request->publishers as $p) {
   	DB::table('offers_publisher')->insert(['offer_id'=>$id,'publisher_id'=>$p]);
   }
}
   return redirect()->back()->with('success', 'Offer Created Successfully');
    }









       public function DeleteOffer(Request $request)
    {
$qry=DB::table('offers')->where('id',$request->id)->delete();
return $qry;
    }
       public function UpdateOffer(Request $request)
    {
    	$imageName='';
    	$icon_url='';

    	  if($request->preview_link!=''){
 @unlink('uploads/'.$request->hidden_preview_image);
 $imageName = mt_rand(1,1000).''.time() . '.' . $request->file('preview_link')->getClientOriginalExtension();
  $request->file('preview_link')->move('uploads', $imageName);
 }
 else{
 	$imageName=$request->hidden_preview_image;
 }

  if($request->icon_url!=''){
  @unlink('uploads/'.$request->hidden_icon_image);
 $icon_url = mt_rand(1,1000).''.time() . '.' . $request->file('icon_url')->getClientOriginalExtension();
  $request->file('icon_url')->move('uploads', $icon_url);
 }
 else{
 		$icon_url=$request->hidden_icon_image;
 }


        $data=array(
        	'offer_name'=>$request->offer_name,
        	'advertiser_id'=>$request->advertiser_id,
        	'offer_type'=>$request->offer_type,
        	'advertiser_officer_id'=>$request->advertiser_offer_id,
        	'verticals'=>$request->verticals,
        	'tracking_domain_id'=>$request->tracking_domain_id,
        	'category_id'=>$request->category_id,
        	'description'=>$request->description,
        	'requirements'=>$request->requirements,
        	'link'=>$request->link,
        	'preview_url'=>$imageName,
        	'icon_url'=>$icon_url,
        		'browsers'=>implode($request->browser,'|'),
        	'lead_qty'=>$request->lead_qty,
        	'payout'=>$request->payout_amount,
        	'countries'=>implode($request->countries,'|'),
        	'ua_target'=>implode($request->ua_target,'|'),
        'status'=>$request->status,
        	'clicks'=>$request->clicks,
        	'conversion'=>$request->conversion,
        	'featured_offer'=>$request->featured==null?0:1,
        	'incentive_allowed'=>$request->incentive==null?0:1,
        	'smartlink'=>$request->smartlink==null?0:1,
        	'magiclink'=>$request->magiclink==null?0:1,
        	'lockers'=>$request->lockers==null?0:1,
        	'native'=>$request->native==null?0:1,
        	'payout_type'=>$request->payout
        );
    DB::table('offers')->where('id',$request->id)->update($data);


    DB::table('offers_publisher')->where('offer_id',$request->id)->delete();
    if($request->offer_type=='special'){
  foreach ($request->publishers as $p) {
   	DB::table('offers_publisher')->insert(['offer_id'=>$request->id,'publisher_id'=>$p]);
   }
}
   return redirect()->back()->with('success', 'Offer Updated Successfully');
    }




}
