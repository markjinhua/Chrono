<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class AdvertiserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin','2faadmin']);
    }



       public function ManageAdvertiser()
    {
        return view('admin.Manage_Advertiser');
    }
          public function ShowAdvertiser()
    {

    	$data=DB::table('advertisers as c')->orderBy('c.id','desc')->limit(400)->get();
        return response()->json($data);
    }
       

    
          public function EditAdvertiser(Request $request)
    {
    	$data=DB::table('advertisers  as c')->where('c.id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteAdvertiser(Request $request)
    {
    	$data=DB::table('advertisers')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertAdvertiser(Request $request)
    {
      $photo='';
          if($request->photo!=''){
  
 $photo = mt_rand(1,1000).''.time() . '.' . $request->file('photo')->getClientOriginalExtension();
  $request->file('photo')->move('uploads', $photo); 
 }

    	$data=array(
    			'advertiser_name'=>$request->advertiser_name,
    			'password'=>Hash::make($request->password),
    			'company_name'=>$request->company_name,
    				'email'=>$request->email,
    			'hereby'=>$request->hereby,
                'advertiser_image'=>$photo,
                'param1'=>$request->param1,
                'param2'=>$request->param2,
    			);
    	DB::table('advertisers')->insert($data);
       return redirect()->back()->with('success', 'Advertiser Created Successfully');
    }
      public function UpdateAdvertiser(Request $request)
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

    	$data=array(
    		  'advertiser_name'=>$request->advertiser_name1,
                
                'company_name'=>$request->company_name1,
                    'email'=>$request->email1,
                'hereby'=>$request->hereby1,
                 'advertiser_image'=>$imageName,
                 'status'=>$request->status1,
                  'param1'=>$request->param11,
                'param2'=>$request->param21,
    			 
    			);
    	DB::table('advertisers')->where('id',$request->id)->update($data);
         return redirect()->back()->with('success', 'Advertiser Updated Successfully');
    }

}

