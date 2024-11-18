<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\UserSystemInfoHelper;
use App\SiteSetting;
use Hash;
use Mail;
use Auth;
use Illuminate\Support\Facades\Config;
use Redirect;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('welcome');
    }
     public function arabic_home()
    {
        return view('arabic_home');
    }

public function Click(Request $request){

 $campid=$request->query('camp');
 $pubid=$request->query('pubid');


    $subid=$request->query('sid');
    $subid2=$request->query('sid2');
    $subid3=$request->query('sid3');
    $subid4=$request->query('sid4');
    $subid5=$request->query('sid5');
    $ip=$_SERVER['REMOTE_ADDR'];
    $timeout=5;


    $setting_vpn=DB::table('site_settings')->where('id', '1')->first();

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    //smaller than =0,means not using vpn and if greater than 0 means using vpn it will not go to advertiser url,plz close your vpn then try again
    //if you're using custom flags (like flags=m), change the URL below
    if($setting_vpn->vpn_check == 'yes'){
      //Commented 30_06
      curl_setopt($ch, CURLOPT_URL, "http://proxycheck.io/v2/".$ip."?key=".$setting_vpn->vpn_api."0&risk=1&vpn=1");
    }else{
      //New Added  30_06
      curl_setopt($ch, CURLOPT_URL, url('/api/bypass/ip'));
    }

    $response=curl_exec($ch);

    curl_close($ch);

    $data = \Location::get($ip);

    $country=$data->countryName;

    $getbrowser = UserSystemInfoHelper::get_browsers();

    $getos = UserSystemInfoHelper::get_os();

    //CHECKING VPN
    $v = json_decode($response, true);
    $v['type'] = $v;

if($v['type']=='VPN'){


echo "<h1>You are using vpn , close it and try again</h1>";
$inc=DB::table('publishers')->where('id',$pubid)->increment('vpn_clicks',1);
$pu=DB::table('publishers')->where('id',$pubid)->first();
if($pu->vpn_clicks >= env('VPN_CLICK_LIMIT')){
  echo "This Publisher is Banned from Our Network";

  DB::table('publishers')->where('id',$pubid)->update(['status'=>'banned']);

  $data=array('name' => $pu->name, 'publisher_id' => $pu->id ,'message'=>'Your Account has been Banned Due to Exceeded Vpn Clicks','subject'=>'Account Ban','email'=>$pu->email);

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
      $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_HOME_NAME'));
 $message->to($data ['email'], 'Publisher')->subject
            ($data['subject']);


      });
   Auth::guard('publisher')->logout();



}

}
else{


    $qry=DB::select("select *,id as oid from offers where id='$campid'  and (countries like '%$country%' or countries='ALL') and browsers like '%$getbrowser%' and ua_target like '%$getos%'  limit 1 ");







    $var='0';
    if(sizeof($qry)>0){
    if($qry[0]->offer_type=='public'){
$var='1';
    }
    elseif($qry[0]->offer_type=='private'){

            $qry1=DB::table('approval_request')->where('offer_id',$campid)->where('publisher_id',$pubid)->first();
            if($qry1=='')
            {

            }
            else{
                if($qry1->approval_status=='Approved'){
                    $var='1';
                }
            }
    }
    else {

        $qry2=DB::table('offers_publisher')->where('offer_id',$campid)->where('publisher_id',$pubid)->first();

        if($qry2!=''){
            $var='1';
        }

    }
}


  $code = md5(rand(1,999999));

if($var=='1'){
 $unique='1';
$checkUnique=DB::table('offer_process')->where('offer_id',$qry[0]->oid)->where('advertiser_offer_id',$qry[0]->advertiser_officer_id)->where('ip_address',$ip)->where('publisher_id',$pubid)->first();
if($checkUnique!=''){
    $unique=0;
}

$amount=0;
$admin_amount=0;
$publisher_earnings=0;
  $site=DB::table('site_settings')->first();
  $total_perc=$qry[0]->payout_percentage+$site->affliate_manager_salary_percentage;
if($qry[0]->payout_type=='revshare'){

    $amount=0;
}
else{

  $admin_amount=$qry[0]->payout-($qry[0]->payout*$total_perc/100);

$publisher_earnings=$qry[0]->payout*$qry[0]->payout_percentage/100;
}
$offerProcessData=array(
        'offer_id'=>$qry[0]->oid,
        'advertiser_offer_id'=>$qry[0]->advertiser_officer_id,
        'offer_name'=>$qry[0]->offer_name,
        'ua_target'=>$getos,
        'browser'=>$getbrowser,
        'country'=>$country,
        'ip_address'=>$ip,
        'code'=>$code,
        'unique_'=>$unique,
        'publisher_id'=>$pubid,
        'payout_type'=>$qry[0]->payout_type,
        'payout'=>$qry[0]->payout,
        'publisher_earned'=>$publisher_earnings,
        'source'=>request()->headers->get('referer'),
        'sid'=>$request->query('sid'),
        'sid2'=>$request->query('sid2'),
        'sid3'=>$request->query('sid3'),
        'sid4'=>$request->query('sid4'),
        'sid5'=>$request->query('sid5'),
        'status'=>'Pending',
        'admin_earned'=>$admin_amount,
        'advertiser_id'=>$qry[0]->advertiser_id

);

  DB::table('offers')->where('id',$qry[0]->oid)->increment('clicks',1);

  DB::table('offer_process')->insert($offerProcessData);
$network=DB::table('advertisers')->where('id',$qry[0]->advertiser_id)->first();

   $q='';
 if($network->param2==null || $network->param2==''){
 $q = "&$network->param1=$code&";
 }
 else{

        $q = "&$network->param1=$code&$network->param2=$pubid&";

   }

  return Redirect::to($qry[0]->link.$q);


}
else{
//FOR SMARTLINK

      $qry=DB::select("SELECT *,o.id as oid   FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$pubid' and ap.approval_status='Approved'  join offers_publisher as op on op.offer_id=o.id and op.publisher_id='$pubid'    where   (countries like '%$country%' or countries='ALL')  and browsers like '%$getbrowser%' and ua_target like '%$getos%'  and smartlink=1 and  o.status='Active' order by rand() limit 1");


if(isset($qry[0])){
    //OFFER NOT VALID FOR YOU
     $unique='1';
$checkUnique=DB::table('offer_process')->where('offer_id',$qry[0]->oid)->where('advertiser_offer_id',$qry[0]->advertiser_officer_id)->where('ip_address',$ip)->where('publisher_id',$pubid)->first();
if($checkUnique!=''){
    $unique=0;
}

$amount=0;
$admin_amount=0;
$publisher_earnings=0;
  $site=DB::table('site_settings')->first();
  $total_perc=$qry[0]->payout_percentage+$site->affliate_manager_salary_percentage;
if($qry[0]->payout_type=='revshare'){

    $amount=0;
}
else{

  $admin_amount=$qry[0]->payout-($qry[0]->payout*$total_perc/100);

$publisher_earnings=$qry[0]->payout*$qry[0]->payout_percentage/100;
}
$offerProcessData=array(
        'offer_id'=>$qry[0]->oid,
        'advertiser_offer_id'=>$qry[0]->advertiser_officer_id,
        'offer_name'=>$qry[0]->offer_name,
        'ua_target'=>$getos,
        'browser'=>$getbrowser,
        'country'=>$country,
        'ip_address'=>$ip,
        'code'=>$code,
        'unique_'=>$unique,
        'publisher_id'=>$pubid,
        'payout_type'=>$qry[0]->payout_type,
        'payout'=>$qry[0]->payout,
        'publisher_earned'=>$publisher_earnings,
        'source'=>request()->headers->get('referer'),
        'admin_earned'=>$admin_amount,
        'sid'=>$request->query('sid'),
        'sid2'=>$request->query('sid2'),
        'sid3'=>$request->query('sid3'),
        'sid4'=>$request->query('sid4'),
        'sid5'=>$request->query('sid5'),
        'status'=>'Pending',
        'advertiser_id'=>$qry[0]->advertiser_id

);

  DB::table('offers')->where('id',$qry[0]->oid)->increment('clicks',1);

  DB::table('offer_process')->insert($offerProcessData);
$network=DB::table('advertisers')->where('id',$qry[0]->advertiser_id)->first();
 $q='';
 if($network->param2==null || $network->param2==''){
 $q = "&$network->param1=$code&";
 }
 else{

        $q = "&$network->param1=$code&$network->param2=$pubid&";

   }

  return Redirect::to($qry[0]->link.$q);
}
else {


//FOR RANDOM
 $qry=DB::select("SELECT *,o.id as oid  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$pubid' and ap.approval_status='Approved' left  join offers_publisher as op on op.offer_id=o.id and op.publisher_id='$pubid'    where   (countries like '%$country%' or countries='ALL') and browsers like '%$getbrowser%' and ua_target like '%$getos%'  and   o.status='Active' order by rand() limit 1");

if(isset($qry[0])){
    //OFFER NOT VALID FOR YOU
     $unique='1';
$checkUnique=DB::table('offer_process')->where('offer_id',$qry[0]->oid)->where('advertiser_offer_id',$qry[0]->advertiser_officer_id)->where('ip_address',$ip)->where('publisher_id',$pubid)->first();
if($checkUnique!=''){
    $unique=0;
}

$amount=0;
$publisher_earnings=0;
$admin_amount=0;
  $site=DB::table('site_settings')->first();
  $total_perc=$qry[0]->payout_percentage+$site->affliate_manager_salary_percentage;
if($qry[0]->payout_type=='revshare'){

    $amount=0;
}
else{

  $admin_amount=$qry[0]->payout-($qry[0]->payout*$total_perc/100);

$publisher_earnings=$qry[0]->payout*$qry[0]->payout_percentage/100;
}
$offerProcessData=array(
        'offer_id'=>$qry[0]->oid,
        'advertiser_offer_id'=>$qry[0]->advertiser_officer_id,
        'offer_name'=>$qry[0]->offer_name,
        'ua_target'=>$getos,
        'browser'=>$getbrowser,
        'country'=>$country,
        'ip_address'=>$ip,
        'code'=>$code,
        'unique_'=>$unique,
        'publisher_id'=>$pubid,
        'payout_type'=>$qry[0]->payout_type,
        'payout'=>$qry[0]->payout,
        'publisher_earned'=>$publisher_earnings,
        'admin_earned'=>$admin_amount,
        'source'=>request()->headers->get('referer'),
        'sid'=>$request->query('sid'),
        'sid2'=>$request->query('sid2'),
        'sid3'=>$request->query('sid3'),
        'sid4'=>$request->query('sid4'),
        'sid5'=>$request->query('sid5'),
        'status'=>'Pending',
        'advertiser_id'=>$qry[0]->advertiser_id

);


  DB::table('offer_process')->insert($offerProcessData);
  DB::table('offers')->where('id',$qry[0]->oid)->increment('clicks',1);

$network=DB::table('advertisers')->where('id',$qry[0]->advertiser_id)->first();
$q='';
 if($network->param2==null || $network->param2==''){
 $q = "&$network->param1=$code&";
 }
 else{

        $q = "&$network->param1=$code&$network->param2=$pubid&";

   }


  return Redirect::to($qry[0]->link.$q);
}else{
    echo "No Qualified Offer";
}
}
}

}


     return null;

}







public function Postback(Request $request)
{



 $hash=$request->hash;

 $qry=DB::table('offer_process')->where('code',$hash)->first();
 if($qry==''){
  return 'Invalid Values';
 }
  $postback_url=array('url'=> url()->full(),
      'status'=>$request->status,
      'offer_process_id'=>$qry->id,
      'offer_id'=>$qry->offer_id,
      'publisher_id'=>$qry->publisher_id
);
 $offer=DB::table('offers')->where('id',$qry->offer_id)->first();

           $publisher=DB::table('publishers')->where('id',$qry->publisher_id)->first();

           if($request->payout!=null){


$payout=$request->payout;
  }else{
    $payout=$qry->payout;
  }
  $site=DB::table('site_settings')->first();
              $publisher_earnings=$payout*$offer->payout_percentage/100;
                $total_perc=$offer->payout_percentage+$site->affliate_manager_salary_percentage;
 $amount=0;
$admin_amount=0;
$affliate_earning=0;
 $affliate_earning=($payout*$site->affliate_manager_salary_percentage/100);
 $admin_amount=$payout-($publisher_earnings+$affliate_earning);

        if($request->status==1){

if($qry->status=='Approved' || $qry->status=='Rejected'){
return 'It is already '.$qry->status.'   ,You can not await it';
}else{
   DB::table('offer_process')->where('code',$hash)->update(['status'=>'Approved','payout'=>$payout,'admin_earned'=>$admin_amount,'publisher_earned'=>$publisher_earnings,'affliate_manager_earnings'=>$affliate_earning]);
DB::table('postback_recieve')->insert($postback_url);
}
  }
  elseif($request->status==2){
      DB::table('offer_process')->where('code',$hash)->update(['status'=>'Rejected','payout'=>$payout,'admin_earned'=>$admin_amount,'publisher_earned'=>$publisher_earnings,'affliate_manager_earnings'=>$affliate_earning]);
     DB::table('postback_recieve')->insert($postback_url);

            if($qry->status=='Approved'){
            DB::table('publishers')->where('id',$qry->publisher_id)->decrement('balance',$publisher_earnings);
                 DB::table('publishers')->where('id',$qry->publisher_id)->decrement('total_earnings',$publisher_earnings);
                 DB::table('offers')->where('id',$qry->offer_id)->decrement('leads',1);
                    if($qry->key_!=null){
                 DB::table('smartlinks')->where('key_',$qry->key_)->decrement('earnings',$publisher_earnings);
                    }

                 $pub=DB::table('publishers')->where('id',$qry->publisher_id)->first();

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


$data=array(
'offer_process_id'=>$qry->id,
'amount'=>-1*$publisher_earnings,
'publisher_id'=>$qry->publisher_id);
DB::table('publisher_transactions')->insert($data);


    $data=array(
        'publisher_id'=>$qry->publisher_id,
        'earnings'=>-1*$publisher_earnings,
        'lead'=>-1,
    );
    DB::table('ranking')->insert($data);

  }
}
return 'Postback Recieve Successfully';

}





public function Smartlink(Request $request){

 $campid=$request->query('camp');
 $pubid=$request->query('pubid');


    $codeemail = rand(1,999);

$contactEmail='huza'.$codeemail.'@gmail.com';

    $subid=$request->query('sid');
    $subid2=$request->query('sid2');
    $subid3=$request->query('sid3');
    $subid4=$request->query('sid4');
    $subid5=$request->query('sid5');
        $ip=$_SERVER['REMOTE_ADDR'];

    $setting_vpn=DB::table('site_settings')->where('id', '1')->first();
    $timeout=5;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    //smaller than =0,means not using vpn and if greater than 0 means using vpn it will not go to advertiser url,plz close your vpn then try again
    //if you're using custom flags (like flags=m), change the URL below
    if($setting_vpn->vpn_check == 'yes'){
      //Commented 30_06
      curl_setopt($ch, CURLOPT_URL, "http://proxycheck.io/v2/".$ip."?key=".$setting_vpn->vpn_api."0&risk=1&vpn=1");
    }else{
      //New Added  30_06
      curl_setopt($ch, CURLOPT_URL, url('/api/bypass/ip'));
    }

    $response=curl_exec($ch);

    curl_close($ch);

    $data = \Location::get($ip);

    $country=$data->countryName;

    $getbrowser = UserSystemInfoHelper::get_browsers();

    $getos = UserSystemInfoHelper::get_os();

    //CHECKING VPN
    $v = json_decode($response, true);
    $v['type'] = $v;


 $data = \Location::get($ip);
 $country=$data->countryName == null ? 'Null' : $data->countryName;

 $getbrowser = UserSystemInfoHelper::get_browsers();

 $getos = UserSystemInfoHelper::get_os();
if($v['type']=='VPN'){
echo "<h1>You are using vpn , close it and try again</h1>";
$inc=DB::table('publishers')->where('id',$pubid)->increment('vpn_clicks',1);
$pu=DB::table('publishers')->where('id',$pubid)->first();
if($pu->vpn_clicks >= env('VPN_CLICK_LIMIT')){
  echo "Your Account is Ban";
  DB::table('publishers')->where('id',$pubid)->update(['status'=>'banned']);
  $data=array('name' => $pu->name, 'publisher_id' => $pu->id ,'message'=>'Your Account has been Banned Due to Exceeded Vpn Clicks','subject'=>'Account Ban','email'=>$pu->email);

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
      $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_HOME_NAME'));
 $message->to($data ['email'], 'Publisher')->subject
            ($data['subject']);


      });
   Auth::guard('publisher')->logout();



}

}
else{
$key=$request->query('key');
$sm=DB::table('smartlinks')->where('key_',$key)->first();
if($sm->enabled==0){
  return 'Smartlink is Pending';
}
if($sm->enabled==2){
    return 'Smartlink is Rejected';
}

$category=DB::table('smartlinks')->where('key_',$key)->first();
    $qry=DB::select("select * from offers as o  where  o.category_id='$category->category_id'
    and (o.countries like '%$country%' or o.countries='ALL') and o.browsers like '%$getbrowser%'  and o.smartlink=1  and o.ua_target like '%$getos%'  order by rand()  limit 1");

    $code = md5(rand(1,999999));

   $var='0';
    if(sizeof($qry)>0){

    if($qry[0]->offer_type=='public'){
$var='1';
    }
    elseif($qry[0]->offer_type=='private'){

            $qry1=DB::table('approval_request')->where('offer_id',$qry[0]->id)->where('publisher_id',$sm->publisher_id)->first();
            if($qry1=='')
            {

            }
            else{
                if($qry1->approval_status=='Approved'){
                    $var='1';
                }
            }
    }
    else {

        $qry2=DB::table('offers_publisher')->where('offer_id',$qry[0]->id)->where('publisher_id',$sm->publisher_id)->first();

        if($qry2!=''){
            $var='1';
        }

    }


 if($var=='1'){
     $unique='1';
$checkUnique=DB::table('offer_process')->where('offer_id',$qry[0]->id)->where('ip_address',$ip)->where('publisher_id',$pubid)->first();
if($checkUnique!=''){
    $unique=0;
}
$amount=0;
$admin_amount=0;
$publisher_earnings=0;
  $site=DB::table('site_settings')->first();
  $total_perc=$qry[0]->payout_percentage+$site->affliate_manager_salary_percentage;
if($qry[0]->payout_type=='revshare'){

    $amount=0;
}
else{

  $admin_amount=$qry[0]->payout-($qry[0]->payout*$total_perc/100);

$publisher_earnings=$qry[0]->payout*$qry[0]->payout_percentage/100;
}
$offerProcessData=array(
        'offer_id'=>$qry[0]->id,
        'advertiser_offer_id'=>$qry[0]->advertiser_officer_id,
        'offer_name'=>$qry[0]->offer_name,
        'ua_target'=>$getos,
        'browser'=>$getbrowser,
        'country'=>$country,
        'ip_address'=>$ip,
        'code'=>$code,
        'unique_'=>$unique,
        'publisher_id'=>$pubid,
        'payout_type'=>$qry[0]->payout_type,
        'payout'=>$qry[0]->payout,
        'publisher_earned'=>$publisher_earnings,
        'admin_earned'=>$admin_amount,
        'source'=>request()->headers->get('referer'),
        'key_'=>$key,
        'status'=>'Pending',
        'advertiser_id'=>$qry[0]->advertiser_id

);

  DB::table('offers')->where('id',$qry[0]->id)->increment('clicks',1);

  DB::table('offer_process')->insert($offerProcessData);
$network=DB::table('advertisers')->where('id',$qry[0]->advertiser_id)->first();
 $q='';
 if($network->param2==null || $network->param2==''){
 $q = "?&$network->param1=$code&";
 }
 else{

        $q = "?&$network->param1=$code&$network->param2=$pubid&";

   }


  return Redirect::to($qry[0]->link.$q);

 }

 else{

 //NOW SELECTING PUBLIC OFFERS
  $qry=DB::select("select * from offers where   category_id='$category->category_id'
                    and (countries like '%$country%' or countries='ALL') and browsers like '%$getbrowser%'   and o.smartlink=1  and offer_type='public'  and ua_target like '%$getos%' order by rand()  limit 1");
   if(sizeof($qry)>0){
      $unique='1';
$checkUnique=DB::table('offer_process')->where('offer_id',$qry[0]->id)->where('ip_address',$ip)->where('publisher_id',$pubid)->first();
if($checkUnique!=''){
    $unique=0;
}
$amount=0;
$admin_amount=0;
$publisher_earnings=0;
  $site=DB::table('site_settings')->first();
  $total_perc=$qry[0]->payout_percentage+$site->affliate_manager_salary_percentage;
if($qry[0]->payout_type=='revshare'){

    $amount=0;
}
else{

  $admin_amount=$qry[0]->payout-($qry[0]->payout*$total_perc/100);

$publisher_earnings=$qry[0]->payout*$qry[0]->payout_percentage/100;
}
$offerProcessData=array(
        'offer_id'=>$qry[0]->id,
        'advertiser_offer_id'=>$qry[0]->advertiser_officer_id,
        'offer_name'=>$qry[0]->offer_name,
        'ua_target'=>$getos,
        'browser'=>$getbrowser,
        'country'=>$country,
        'ip_address'=>$ip,
        'code'=>$code,
        'unique_'=>$unique,
        'publisher_id'=>$pubid,
        'payout_type'=>$qry[0]->payout_type,
        'payout'=>$qry[0]->payout,
        'publisher_earned'=>$publisher_earnings,
        'admin_earned'=>$admin_amount,
        'source'=>request()->headers->get('referer'),
        'key_'=>$key,
        'status'=>'Pending',
        'advertiser_id'=>$qry[0]->advertiser_id

);

  DB::table('offers')->where('id',$qry[0]->id)->increment('clicks',1);

  DB::table('offer_process')->insert($offerProcessData);
$network=DB::table('advertisers')->where('id',$qry[0]->advertiser_id)->first();
 $q='';
 if($network->param2==null || $network->param2==''){
 $q = "?&$network->param1=$code&";
 }
 else{

        $q = "?&$network->param1=$code&$network->param2=$pubid&";

   }


  return Redirect::to($qry[0]->link.$q);


   }

   }

}  else{



    //NOW SELECTING PUBLIC OFFERS
  $qry=DB::select("select * from offers where   (countries like '%$country%' or countries='ALL') and browsers like '%$getbrowser%' and offer_type='public'  and ua_target like '%$getos%' order by rand()  limit 1");
   if(sizeof($qry)>0){
      $unique='1';
$checkUnique=DB::table('offer_process')->where('offer_id',$qry[0]->id)->where('ip_address',$ip)->where('publisher_id',$pubid)->first();
if($checkUnique!=''){
    $unique=0;
}
$amount=0;
$admin_amount=0;
$publisher_earnings=0;
  $site=DB::table('site_settings')->first();
  $total_perc=$qry[0]->payout_percentage+$site->affliate_manager_salary_percentage;
if($qry[0]->payout_type=='revshare'){

    $amount=0;
}
else{

  $admin_amount=$qry[0]->payout-($qry[0]->payout*$total_perc/100);

$publisher_earnings=$qry[0]->payout*$qry[0]->payout_percentage/100;
}
$offerProcessData=array(
        'offer_id'=>$qry[0]->id,
        'advertiser_offer_id'=>$qry[0]->advertiser_officer_id,
        'offer_name'=>$qry[0]->offer_name,
        'ua_target'=>$getos,
        'browser'=>$getbrowser,
        'country'=>$country,
        'ip_address'=>$ip,
        'code'=>$code,
        'unique_'=>$unique,
        'publisher_id'=>$pubid,
        'payout_type'=>$qry[0]->payout_type,
        'payout'=>$qry[0]->payout,
        'publisher_earned'=>$publisher_earnings,
        'admin_earned'=>$admin_amount,
        'source'=>request()->headers->get('referer'),
        'key_'=>$key,
        'status'=>'Pending',
        'advertiser_id'=>$qry[0]->advertiser_id

);

  DB::table('offers')->where('id',$qry[0]->id)->increment('clicks',1);

  DB::table('offer_process')->insert($offerProcessData);
$network=DB::table('advertisers')->where('id',$qry[0]->advertiser_id)->first();
 $q='';
 if($network->param2==null || $network->param2==''){
 $q = "?&$network->param1=$code&";
 }
 else{

        $q = "?&$network->param1=$code&$network->param2=$pubid&";

   }


  return Redirect::to($qry[0]->link.$q);

   }



else{

 echo "No Qualified Offer";

}

}




}



}





public function Api(Request $request){
  if($request->pubid!=null){
    $browser=$request->browser;
    $device=$request->device;
    $category_id=$request->category_id;
    $site=DB::table('site_settings')->first();
    $perc=$site->payout_percentage;

$country=$request->country_name;
    if($category_id!=null){

 $data=DB::select("select o.id,o.offer_name,o.link,o.description,c.category_name,o.ua_target,o.browsers,o.countries,o.payout_type,o.payout as payout,o.lead_qty from offers as o join category as c on c.id=o.category_id where o.offer_type='public' and o.browsers like '%$browser%' and o.ua_target like '%$device%' and o.countries like '%$country%' and o.category_id='$category_id' ");
    }
    else{

      $data=DB::select("select o.id,o.offer_name,o.link,o.description,c.category_name,o.ua_target,o.browsers,o.countries,o.payout_type,o.payout as payout,o.lead_qty from offers as o left join category as c on c.id=o.category_id where o.offer_type='public' and o.countries like '%$country%' and o.browsers like '%$browser%' and o.ua_target like '%$device%'");

  }
  $array=array();
  foreach ($data as $d) {
        $array[]=array('id'=>$d->id,
          'offer_name'=>$d->offer_name,

          'link'=>$site->default_tracking_domain.'/click?camp='.$d->id.'&pubid='.$request->pubid
,
          'description'=>$d->description,
          'category_name'=>$d->category_name,
          'ua_target'=>$d->ua_target,
          'browsers'=>$d->browsers,
          'countries'=>$d->countries,
          'payout_type'=>$d->payout_type,
          'payout'=>$d->payout*$perc/100,
          'lead_qty'=>$d->lead_qty,

      );
  }
     return response()->json($array);
  }
  else
  {
    return 'Enter Publisher Id';
  }
}






public function countries(){
        $qry=DB::table('countries')->get();
        return response()->json($qry);
}
}
