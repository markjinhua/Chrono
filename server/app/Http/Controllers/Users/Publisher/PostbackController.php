<?php
namespace App\Http\Controllers\Users\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use PDF;

class PostbackController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:publisher','2fa']);
    }

    public function Postback()
    {
        return view('publisher.postback');
    }
      public function SendPostback()
    {
        return view('publisher.postback_sent');

    }


    
    public function AddPostback(Request $request){
    	$check=DB::table('postback')->where('publisher_id',Auth::guard('publisher')->id())->first();
    	if($check!=''){
    			DB::table('postback')->where('publisher_id',Auth::guard('publisher')->id())->update(['link'=>$request->postback]);
    	}
    	else{
    		DB::table('postback')->insert(['link'=>$request->postback,'publisher_id'=>Auth::guard('publisher')->id()]);

    	}
    	return redirect()->back();
    }
}