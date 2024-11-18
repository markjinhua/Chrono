<?php
namespace App\Http\Controllers\Users\Publisher;
use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
          $this->middleware(['auth:publisher','2fa']);
    }

    public function AccountInformation()
    {
        $site_settings = SiteSetting::find(1);
        return view('publisher.account_settings', compact('site_settings'));
    }
    public function ShowAllNotifications(){
      return view('publisher.show_all_notifications');
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
    	DB::table('publishers')->where('id',Auth::guard('publisher')->id())->update($data);
       return redirect()->back()->with('success', 'Password Updated  Successfully');
    }


        public function UpdateSettings(Request $request)
    {
      $imagenid='';
      if($request->nid!=''){
 
   $validatedData = $request->validate(['nid' => 'required|image|mimes:jpg,png,jpeg,gif,svg,pdf|max:1024']); //By Hriday
   
 $imagenid = mt_rand(1,1000).''.time() . '.' . $request->file('nid')->getClientOriginalExtension();
  $request->file('nid')->move('uploads', $imagenid);
      @unlink('uploads/'.Auth::guard('publisher')->user()->nid);
      }
      else{
        $imagenid=Auth::guard('publisher')->user()->nid;
      }
           $imagetax='';
      if($request->nid!=''){


   $validatedData = $request->validate(['tax_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg,pdf|max:1024']); //by Hriday

 $imagetax = mt_rand(1,1000).''.time() . '.' . $request->file('tax_file')->getClientOriginalExtension();
  $request->file('tax_file')->move('uploads', $imagetax);
     @unlink('uploads/'.Auth::guard('publisher')->user()->tax_file);
      }
      else{
        $imagetax=Auth::guard('publisher')->user()->tax_file;
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
'tax_note'=>$request->tax_note,
'tax_file'=>$imagetax
);

    	DB::table('publishers')->where('id',Auth::guard('publisher')->id())->update($data);
         return redirect()->back()->with('success', 'Settings Updated  Successfully');

       }
        public function UploadImage(Request $request)
    {

   $validatedData = $request->validate(['file' => 'required|image|mimes:jpg,png,jpeg,gif,svg,pdf|max:1024']);


 $imageName = mt_rand(1,100000).''.time() . '.' . $request->file('file')->getClientOriginalExtension();
  $request->file('file')->move('uploads', $imageName);
  @unlink('uploads/'.Auth::guard('publisher')->user()->publisher_image);

DB::table('publishers')->where('id',Auth::guard('publisher')->id())->update(['publisher_image'=>$imageName]);
return  redirect()->back();

    }

public function RemoveAccount($id){
DB::table('publisher_payment_method')->where('id',$id)->delete();
return  redirect()->back();
}
public function AddPayment(Request $request){
  $primary=0;
  if($request->primary==1){
    DB::table('publisher_payment_method')->where('publisher_id',Auth::guard('publisher')->id())->update(['is_primary'=>0]);
    $primary=1;
  }
$data=array(
  'payment_type'=>$request->payment_type,
  'payment_details'=>$request->payment_details,
  'publisher_id'=>Auth::guard('publisher')->id(),
  'is_primary'=>$primary

             );
DB::table('publisher_payment_method')->insert($data);
return  redirect()->back();
}

}
