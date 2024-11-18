<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Config;
use App\SiteSetting;
use Mail;

class AutoApprove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will execute for auto approve';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->ApprovePendingOfferProcess();
    }





    public function ApprovePendingOfferProcess()
    {

        $site=DB::table('site_settings')->first();

        $offer_proceses = DB::table('offer_process')
        ->where('status', 'Pending')
        // ->where('key_', null)
        ->orderBy('id', 'desc')
        ->get();

            foreach($offer_proceses as $c){


                $qry=DB::table('offer_process')->where('id',$c->id)->first();

            if($qry->status=='Approved'){

                return 1;
            }
            else{
                DB::table('offer_process')->where('id',$c->id)->update(['status'=>'Approved']);

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
                $data=array('message'=>'','subject'=>'Your Offer Process No '.$c->id.' has been Approved','email'=>$publisher->email,'hash'=>$qry->code,'payout'=>$publisher_earnings,'offer_name'=>$qry->offer_name,'ip_address'=>$qry->ip_address,'offer_id'=>$qry->offer_id,'status'=>'Approved','country'=>$qry->country,'device'=>$qry->ua_target,'name'=>$publisher->name);
                $postback=DB::table('postback')->where('publisher_id',$qry->publisher_id)->first();

            if($postback!=null){
            $offer_id=$qry->offer_id;
            $offer_name=$qry->offer_name;
            $status='1';
            $payout=$publisher_earnings;
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
                'payout'=>$publisher_earnings,
                'offer_id'=>$qry->offer_id,
                'url'=>$url,
                    ]
            );
            }

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


                    Mail::send('emails.approveofferprocess',['data'=>$data], function($message) use ($data) {
                        $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_OTHER_NAME'));
                    $message->to($data ['email'], $data ['name'])->subject
                            ($data['subject']);

                        });
                }catch(\Exception $e)
                {

                }


                }

                }    return 1;

    }







}
