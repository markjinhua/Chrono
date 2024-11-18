<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CashoutController extends Controller
{
    public function __construct()
    {
         $this->middleware(['auth:admin','2faadmin']);
    }



       public function ManageCashout()
    {
        return view('admin.Manage_Cashout');
    }
          public function ShowCashout()
    {
    	$data=DB::table('cashout_request as c')->select('c.created_at','c.amount','c.status','c.payterm','c.from_date','c.to_date','p.name','c.payment_details','c.method','c.id','c.id as cashout_id')->join('publishers as p','p.id','=','c.affliate_id')->orderBy('c.id','desc')->limit(400)->get();
        return response()->json($data);
    }

       public function ManageCashoutAffliate()
    {
        return view('admin.Manage_Cashout_Affliate');
    }
          public function ShowCashoutAffliate()
    {
        $data=DB::table('affliate_withdraw as c')->select('c.created_at','c.amount','c.status','c.payterm','c.from_date','c.to_date','p.name','c.payment_details','c.method','c.id','c.id as cashout_id')->join('affliates as p','p.id','=','c.affliate_id')->orderBy('c.id','desc')->limit(400)->get();
        return response()->json($data);
    }
       public function SearchCashout(Request $request)
    {
    	$data=DB::table('cashout_request as c')->select('c.created_at','c.amount','c.status','c.payterm','c.from_date','c.to_date','p.name','c.method','c.id','c.id as cashout_id')->join('publishers as p','p.id','=','c.affliate_id')->where('c.status','like','%'.$request->statussearch.'%')->where('c.affliate_id','like','%'.$request->affliatesearch.'%')->orderBy('c.id','desc')->get();
        return response()->json($data);
    }


          public function EditCashout(Request $request)
    {
    	$data=DB::table('cashout_request  as c')->select('c.created_at','c.amount','c.status','c.payterm','c.from_date','c.to_date','c.affliate_id','p.name','c.note','c.payment_details','c.method','c.id','c.id as cashout_id')->join('publishers as p','p.id','=','c.affliate_id')->where('c.id',$request->id)->first();
        return response()->json($data);
    }
     public function EditCashoutAffliate(Request $request)
    {
        $data=DB::table('affliate_withdraw  as c')->select('c.created_at','c.amount','c.status','c.payterm','c.from_date','c.to_date','c.affliate_id','p.name','c.note','c.payment_details','c.method','c.id','c.id as cashout_id')->join('affliates as p','p.id','=','c.affliate_id')->where('c.id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteCashout(Request $request)
    {
    	$data=DB::table('cashout_request')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertCashout(Request $request)
    {
        $publisher=DB::table('publisher_payment_method')->where('publisher_id',$request->affliate_id)
        ->where('is_primary', '1')
        ->first();
        if(!isset($publisher)){
            return "Payment Method Not Added For This Publisher";
        }
if($request->amount>$request->balance){
  return redirect()->back()->with('success', 'Exceeding Balance Amount');
}

$qry=DB::table('cashout_request')->where('status','!=',"Completed")->where('status','!=','Rejected')->sum('amount');
DB::table('publishers')->where('id',$request->affliate_id)->decrement('balance',$request->amount);

    	$data=array(
    			'affliate_id'=>$request->affliate_id,
    			'from_date'=>$request->from_date,
                'payterm'=>$request->payment_terms,
    			'to_date'=>$request->to_date,
    				'amount'=>$request->amount,
    			'note'=>$request->note,
                'payment_details' => $publisher->payment_details,
                'method' => $publisher->payment_type,
    			);
    	DB::table('cashout_request')->insert($data);
            DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$request->amount,
            'publisher_id'=>$request->affliate_id
        ]);
       return redirect()->back()->with('success', 'Cashout Created Successfully');
    }
      public function UpdateCashout(Request $request)
    {
   $pub=DB::table('publishers')->where('id',$request->publisher_id)->first();

    $old_amount=$request->old_amount;
    $net_amount=$request->amount1-$request->old_amount;



    	   $qry=DB::table('cashout_request')->where('id',$request->id)->first();



if($qry->status=='Cancelled'){
if($request->status!='Cancelled'){
    if($request->amount1<=$pub->balance){

        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$request->amount1,
            'publisher_id'=>$request->publisher_id
        ]);
             DB::table('publishers')->where('id',$request->publisher_id)->decrement('balance',$request->amount1);

    }
    else{
        return redirect()->back()->with('success','Exceeding Balance Amount');
    }
}

}
else{
    if($request->status=='Cancelled'){
           DB::table('publisher_transactions')->insert(
            ['amount'=>$request->amount1,
            'publisher_id'=>$request->publisher_id
        ]);
             DB::table('publishers')->where('id',$request->publisher_id)->increment('balance',$request->amount1);

    }
    else{
        if($request->amount1!=$request->old_amount){

            if($net_amount>0){

                if($pub->balance>=$net_amount){

  DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$net_amount,
            'publisher_id'=>$request->publisher_id
        ]);
             DB::table('publishers')->where('id',$request->publisher_id)->decrement('balance',$net_amount);

                }
                else{
                           return redirect()->back()->with('success','Exceeding Balance Amount');
                }
            }
            else{
                     DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$net_amount,
            'publisher_id'=>$request->publisher_id
        ]);
             DB::table('publishers')->where('id',$request->publisher_id)->decrement('balance',$net_amount);
            }
        }
        else{

        }
    }
}






    $data=array(
            'status'=>$request->status,
            'amount'=>$request->amount1,
                 );
      DB::table('cashout_request')->where('id',$request->id)->update($data);

         return redirect()->back()->with('success', 'Cashout Updated Successfully');

    }



















 public function InsertCashoutAffliate(Request $request)
    {
if($request->amount>$request->balance){
  return redirect()->back()->with('success', 'Exceeding Balance Amount');
}

$qry=DB::table('affliate_withdraw')->where('status','!=',"Completed")->where('status','!=','Rejected')->sum('amount');
DB::table('affliates')->where('id',$request->affliate_id)->decrement('balance',$request->amount);

        $data=array(
                'affliate_id'=>$request->affliate_id,
                'from_date'=>$request->from_date,
                'payterm'=>$request->payment_terms,
                'to_date'=>$request->to_date,
                    'amount'=>$request->amount,
                'note'=>$request->note,
                );

        DB::table('affliate_withdraw')->insert($data);
          DB::table('affliate_transactions')->insert(
            ['amount'=>-1*$request->amount,
            'affliate_id'=>$request->affliate_id
        ]);
       return redirect()->back()->with('success', 'Cashout Created Successfully');
    }
      public function UpdateCashoutAffliate(Request $request)
    {


   $pub=DB::table('affliates')->where('id',$request->affliate_id)->first();

    $old_amount=$request->old_amount;
    $net_amount=$request->amount1-$request->old_amount;



           $qry=DB::table('affliate_withdraw')->where('id',$request->id)->first();



if($qry->status=='Cancelled'){
if($request->status!='Cancelled'){
    if($request->amount1<=$pub->balance){

        DB::table('affliate_transactions')->insert(
            ['amount'=>-1*$request->amount1,
            'affliate_id'=>$request->affliate_id
        ]);
             DB::table('affliates')->where('id',$request->affliate_id)->decrement('balance',$request->amount1);

    }
    else{
        return redirect()->back()->with('success','Exceeding Balance Amount');
    }
}

}
else{
    if($request->status=='Cancelled'){
           DB::table('affliate_transactions')->insert(
            ['amount'=>$request->amount1,
            'affliate_id'=>$request->affliate_id
        ]);
             DB::table('affliates')->where('id',$request->affliate_id)->increment('balance',$request->amount1);

    }
    else{
        if($request->amount1!=$request->old_amount){

            if($net_amount>0){

                if($pub->balance>=$net_amount){

  DB::table('affliate_transactions')->insert(
            ['amount'=>-1*$net_amount,
            'affliate_id'=>$request->affliate_id
        ]);
             DB::table('affliates')->where('id',$request->affliate_id)->decrement('balance',$net_amount);

                }
                else{
                           return redirect()->back()->with('success','Exceeding Balance Amount');
                }
            }
            else{
                     DB::table('affliate_transactions')->insert(
            ['amount'=>-1*$net_amount,
            'affliate_id'=>$request->affliate_id
        ]);
             DB::table('affliates')->where('id',$request->affliate_id)->decrement('balance',$net_amount);
            }
        }
        else{

        }
    }
}






    $data=array(
            'status'=>$request->status,
            'amount'=>$request->amount1,
                 );
      DB::table('affliate_withdraw')->where('id',$request->id)->update($data);

         return redirect()->back()->with('success', 'Cashout Updated Successfully');

    }


    public function CronPayoutNet45(Request $request){

        $site=DB::table('site_settings')->first();

        $publisher=DB::table('publishers as p')->where('p.role','publisher')->where('p.balance','>=',$site->minimum_withdraw_amount)->join('publisher_payment_method as pm','p.id','=','pm.publisher_id')->where('pm.is_primary',1)->where('p.payment_terms','net45')->get();

        foreach ($publisher as $pub) {
             if($pub->balance>=$site->minimum_withdraw_amount){

            $data=array(
            'affliate_id'=>$pub->publisher_id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
            'method'=>$pub->payment_type,
            'status'=>'Pending',
            'payment_details'=>$pub->payment_details,
            'payterm'=>'net45');

        DB::table('cashout_request')->insert($data);

        DB::table('publishers')->where('id',$pub->publisher_id)->decrement('balance',$pub->balance);


        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'publisher_id'=>$pub->publisher_id
        ]);

        }}
      return redirect()->back()->with('success', 'Cashout Updated Successfully');
    }






    public function InstantWithdraw(Request $request){


        $publisher=DB::table('affliates as p')->where('p.balance','>',0)->get();

        foreach ($publisher as $pub) {

            $data=array(
            'affliate_id'=>$pub->id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
             'method'=>$pub->payment_method,
            'status'=>'Pending',
                   'payment_details'=>$pub->payment_description,
            'payterm'=>'Instant Withdraw');

        DB::table('affliate_withdraw')->insert($data);

        DB::table('affliates')->where('id',$pub->id)->decrement('balance',$pub->balance);


        DB::table('affliate_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'affliate_id'=>$pub->id
        ]);

        }
      return redirect()->back()->with('success', 'Cashout Updated Successfully');
    }
















    public function CronPayoutNetWeekly(Request $request){

        $site=DB::table('site_settings')->first();

        $publisher=DB::table('publishers as p')->where('p.role','publisher')->where('p.balance','>=',$site->minimum_withdraw_amount)->join('publisher_payment_method as pm','p.id','=','pm.publisher_id')->where('pm.is_primary',1)->where('p.payment_terms','netweekly')->get();

        foreach ($publisher as $pub) {
             if($pub->balance>=$site->minimum_withdraw_amount){

            $data=array(
            'affliate_id'=>$pub->publisher_id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
            'method'=>$pub->payment_type,
            'status'=>'Pending',
            'payment_details'=>$pub->payment_details,
            'payterm'=>'netweekly');

        DB::table('cashout_request')->insert($data);

        DB::table('publishers')->where('id',$pub->publisher_id)->decrement('balance',$pub->balance);


        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'publisher_id'=>$pub->publisher_id
        ]);

        }}
         return redirect()->back()->with('success', 'Cashout Updated Successfully');
    }

  public function CronPayoutNet30(Request $request){

        $site=DB::table('site_settings')->first();


        $publisher=DB::table('publishers as p')->where('p.role','publisher')->where('p.balance','>=',$site->minimum_withdraw_amount)->join('publisher_payment_method as pm','p.id','=','pm.publisher_id')->where('pm.is_primary',1)->where('p.payment_terms','net30')->get();

        foreach ($publisher as $pub) {
             if($pub->balance>=$site->minimum_withdraw_amount){

            $data=array(
            'affliate_id'=>$pub->publisher_id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
            'method'=>$pub->payment_type,
            'status'=>'Pending',
            'payment_details'=>$pub->payment_details,
            'payterm'=>'net30');

        DB::table('cashout_request')->insert($data);

        DB::table('publishers')->where('id',$pub->publisher_id)->decrement('balance',$pub->balance);


        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'publisher_id'=>$pub->publisher_id
        ]);

}        }
       return redirect()->back()->with('success', 'Cashout Updated Successfully');
    }




  public function CronPayoutNet15(Request $request){

        $site=DB::table('site_settings')->first();

        $publisher=DB::table('publishers as p')->where('p.role','publisher')->where('p.balance','>=',$site->minimum_withdraw_amount)->join('publisher_payment_method as pm','p.id','=','pm.publisher_id')->where('pm.is_primary',1)->where('p.payment_terms','net15')->get();

        foreach ($publisher as $pub) {
             if($pub->balance>=$site->minimum_withdraw_amount){

            $data=array(
            'affliate_id'=>$pub->publisher_id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
            'method'=>$pub->payment_type,
            'status'=>'Pending',
            'payment_details'=>$pub->payment_details,
            'payterm'=>'net15');

        DB::table('cashout_request')->insert($data);
    DB::table('cashout_request')->insert($data);

        DB::table('publishers')->where('id',$pub->publisher_id)->decrement('balance',$pub->balance);


        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'publisher_id'=>$pub->publisher_id
        ]);

}        }
       return redirect()->back()->with('success', 'Cashout Updated Successfully');

    }




  public function CronPayoutNet7(Request $request){

        $site=DB::table('site_settings')->first();

        $publisher=DB::table('publishers as p')->where('p.role','publisher')->where('p.balance','>=',$site->minimum_withdraw_amount)->join('publisher_payment_method as pm','p.id','=','pm.publisher_id')->where('pm.is_primary',1)->where('p.payment_terms','net7')->get();

        foreach ($publisher as $pub) {
             if($pub->balance>=$site->minimum_withdraw_amount){

            $data=array(
            'affliate_id'=>$pub->publisher_id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
            'method'=>$pub->payment_type,
            'status'=>'Pending',
            'payment_details'=>$pub->payment_details,
            'payterm'=>'net7');

        DB::table('cashout_request')->insert($data);
    DB::table('cashout_request')->insert($data);

        DB::table('publishers')->where('id',$pub->publisher_id)->decrement('balance',$pub->balance);


        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'publisher_id'=>$pub->publisher_id
        ]);

}        }
          return redirect()->back()->with('success', 'Cashout Updated Successfully');
    }
  public function CronPayoutOnRequested(Request $request){

        $site=DB::table('site_settings')->first();

        $publisher=DB::table('publishers as p')->where('p.role','publisher')->where('p.balance','>=',$site->minimum_withdraw_amount)->join('publisher_payment_method as pm','p.id','=','pm.publisher_id')->where('pm.is_primary',1)->where('p.payment_terms','On Requested')->get();


        foreach ($publisher as $pub) {
 if($pub->balance>=$site->minimum_withdraw_amount){

            $data=array(
            'affliate_id'=>$pub->publisher_id,
            'from_date'=>date('Y-m-d'),
            'to_date'=>'',
            'amount'=>$pub->balance,
            'note'=>'',
            'method'=>$pub->payment_type,
            'status'=>'Pending',
            'payment_details'=>$pub->payment_details,
            'payterm'=>'On Requested');

        DB::table('cashout_request')->insert($data);

      DB::table('cashout_request')->insert($data);

        DB::table('publishers')->where('id',$pub->publisher_id)->decrement('balance',$pub->balance);


        DB::table('publisher_transactions')->insert(
            ['amount'=>-1*$pub->balance,
            'publisher_id'=>$pub->publisher_id
        ]);
        }
    }
        return redirect()->back()->with('success', 'Cashout Updated Successfully');
    }


}

