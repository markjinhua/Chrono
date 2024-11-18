<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class AffliateManagerController extends Controller
{
    public function __construct()
    {
         $this->middleware(['auth:admin','2faadmin']);
    }



       public function ManageAffliateManager()
    {
        return view('admin.Manage_AffliateManager');
    }
          public function ShowAffliateManager()
    {
    	$data=DB::table('affliates as c')->orderBy('c.id','desc')->limit(400)->get();
        return response()->json($data);
    }
       
    
          public function EditAffliateManager(Request $request)
    {
    	$data=DB::table('affliates  as c')->where('c.id',$request->id)->first();
        return response()->json($data);
    }
      public function DeleteAffliateManager(Request $request)
    {
    	$data=DB::table('affliates')->where('id',$request->id)->delete();
        return response()->json($data);
    }
       public function InsertAffliateManager(Request $request)
    {
        if($request->password!=$request->confirm_password){
            $request->session()->flash('success', 'Password Not Match');
             return redirect()->back()->with('success', 'Password Not Match');
        }
         $photo='';
          if($request->photo!=''){
  
 $photo = mt_rand(1,1000).''.time() . '.' . $request->file('photo')->getClientOriginalExtension();
  $request->file('photo')->move('uploads', $photo); 
 }
    	$data=array(
    			'name'=>$request->name,
    			'password'=> Hash::make($request->password),
    			'email'=>$request->email,
    				'skype'=>$request->skype,
                'status'=>$request->status,
    			'address'=>$request->address,
                'photo'=>$photo,
                'power_mode' => $request->power_mode,
                'created_at' => now(),
                'updated_at' => now(),
    			);
    	DB::table('affliates')->insert($data);
       return redirect()->back()->with('success', 'Affliate Manager Created Successfully');
    }
      public function UpdateAffliateManager(Request $request)
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
    		  'name'=>$request->name1,
                 
                'email'=>$request->email1,
                    'skype'=>$request->skype1,
                      'status'=>$request->status1,
                'address'=>$request->address1,
                'photo'=>$imageName,
                'power_mode' => $request->power_mode,
    			 
    			);
    	DB::table('affliates')->where('id',$request->id)->update($data);
         return redirect()->back()->with('success', 'AffliateManager Updated Successfully');
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
      DB::table('affliates')->where('id',$request->password_id)->update($data);
       return redirect()->back()->with('success', 'Password Updated  Successfully');
    }


}

