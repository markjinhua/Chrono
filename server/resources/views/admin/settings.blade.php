@extends('admin.admin_layouts.header')
@extends('admin.admin_layouts.sidebar')
@extends('admin.admin_layouts.footer')
@section('content')




            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card radius-10">
                              <div class="card-header">

            <h4>Settings </h4>

                              </div>
                              <div class="card-body">
    	<form action="{{url('admin/change-password')}}" method="post">
    		@csrf
    		<input type="hidden" name="id" value="{{Auth::guard('admin')->id()}}" >
    	<div class="row">
    		<div class="col-lg-12">
    			<h3>Change Password</h3>
    		</div>
    		<div class="col-lg-4">
    			<label class="form-label">New Password</label>
    			<input  class="form-control" type="" name="password">

    		</div>
    				<div class="col-lg-4">
    			<label class="form-label">Confirm Password</label>

    			<input class="form-control" type="" name="confirm_password">
    		</div>
    			<div class="col-lg-4">
    			<button class="btn btn-dark " style="margin-top: 28px">Change</button>


    		</div>
    </div>
</form>
<?php
$data=DB::table('site_settings')->first();
?>
<form action="{{url('admin/update-settings')}}" method="post" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" value="{{Auth::guard('admin')->id()}}" >
    <div class="row mt-5">
    		<div class="col-lg-6">
    			<h3>Edit Site Information</h3>
    		</div>

    	 <input type="hidden" name="hidden_logo" value="{{$data->logo}}">
          <input type="hidden" name="hidden_icon" value="{{$data->icon}}">
    				<div class="col-lg-12">
    			<label class="form-label">Approve User On Signup</label>

    			<input class="form-" type="checkbox" value="1" name="auto_signup"  {{isset($data)?$data->auto_signup==1?'checked':null:null}}>
    		</div>

    			<div class="col-lg-12">
    			<label class="form-label">Minimum Withdraw Amount</label>

    			<input class="form-control" type="number"  value="{{$data->minimum_withdraw_amount}}" name="minimum_withdraw_amount">
    		</div>
    		<div class="col-lg-12">
    			<label class="form-label">Publisher Payout Percentage</label>

    			<input class="form-control" type="number" value="{{$data->payout_percentage}}"  name="payout_percentage">
    		</div>

            <div class="col-lg-12">
                <label class="form-label">Affliate Manager Payout Percentage</label>

                <input class="form-control" type="number" value="{{$data->affliate_manager_salary_percentage}}"  name="affliate_percentage">
            </div>
            
            <!--<div class="col-lg-12">
                <label class="form-label">Referal Percentage</label>

             <input class="form-control" type="number" value="{{$data->referral_percentage}}"  name="referral_percentage">
            </div>
            <div class="col-lg-12">
                <label class="form-label">Disable Signup</label>

                <input class="form-" type="checkbox"   name="disable_signup" value="1"  {{isset($data)?$data->disable_signup==1?'checked':null:null}}>
            </div>-->
            
                   <div class="col-lg-12">
                <label class="form-label">Default Smartlink  Domain</label>

                <select type="text" name="default_smartlink_domain" class="form-control"  required="">
      <option value="">Default Smartlink Domain</option>
      <?php
    $qry=DB::table('smartlink_domain')->get();
    foreach($qry as $q){?>
 <option value="{{$q->url}}"   {{isset($data)?$data->default_smartlink_domain==$q->url?'selected':null:null}}>{{$q->url}}</option>

  <?php }
  ?>
    </select>

            </div>
                   <div class="col-lg-12">
                <label class="form-label">Default Tracking Domain</label>

                <select type="text" name="default_tracking_domain" class="form-control"  required="">
      <option value="">Default Tracking Domain</option>
      <?php
    $qry=DB::table('domain')->get();
    foreach($qry as $q){?>
 <option value="{{$q->domain_name}}"   {{isset($data)?$data->default_tracking_domain==$q->domain_name?'selected':null:null}}>{{$q->domain_name}}</option>

  <?php }
  ?>
    </select>

            </div>
              <div class="col-lg-12">
                <label class="form-label">Default Affliate Manager</label>
                <select type="text" name="affliate_manager" class="form-control"  required="">
      <option value="">Select Affliate Manager</option>
      <?php
    $qry=DB::table('affliates')->get();
    foreach($qry as $q){?>
 <option value="{{$q->id}}"   {{isset($data)?$data->default_affliate_manager==$q->id?'selected':null:null}}>{{$q->name}}</option>

  <?php }
  ?>
    </select>
            </div>

            <!--  Updates 30_06 -->

            <div class="col-lg-12">
                <label class="form-label"> When Publishers will get Paid?</label>

                <select type="text" name="default_payment_terms" class="form-control"  required="">
                    <option @if($data->default_payment_terms == 'net45') selected @endif value="net45">Every 45 Days</option>
                    <option @if($data->default_payment_terms == 'net30') selected @endif value="net30">Monthly</option>
                    <option @if($data->default_payment_terms == 'net15') selected @endif value="net15">Every 15 days</option>
                    <option @if($data->default_payment_terms == 'netweekly') selected @endif value="netweekly">Weekly</option>
                 </select>

            </div>


            <!-- End -->

    		<div class="col-lg-6 mt-2">
    			<label class="form-label">Logo (2000px X 699px)</label>

    			<input class="form-control" type="file"    name="logo">
    		</div>
    		<div class="col-lg-6 mt-2" >
    			<a href="{{asset('site_images')}}/{{$data->logo}}" target="_blank"><img src="{{asset('site_images')}}/{{$data->logo}}" height="100"></a>
    		</div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Icon (85px X 85px)</label>

                <input class="form-control" type="file"    name="icon">
            </div>



            <div class="col-lg-6 mt-2" >
                <a href="{{asset('site_images')}}/{{$data->icon}}" target="_blank"><img src="{{asset('site_images')}}/{{$data->icon}}" width="100" height="100"></a>
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Vpn Api</label>

                <input class="form-control" type="text" value="{{$data->vpn_api}}"  name="vpn_api">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Vpn Check</label>
                <select name="vpn_check" class="form-control">
                    <option>--select--</option>
                    <option {{$data->vpn_check == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
                    <option {{$data->vpn_check == 'no' ? 'selected' : ''}} value="no">No</option>
                </select>
            </div>


            <div class="col-lg-6 mt-2">
                <label class="form-label">Host</label>
                <input class="form-control" type="text" value="{{$data->smtp_host}}"  name="smtp_host">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Smtp Port</label>
                <input class="form-control" type="text" value="{{$data->smtp_port}}"  name="smtp_port">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Smtp User</label>
                <input class="form-control" type="text" value="{{$data->smtp_user}}"  name="smtp_user">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Smtp Password</label>
                <input class="form-control" type="text" value="{{$data->smtp_password}}"  name="smtp_password">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Smtp Enc</label>
                <select name="smtp_enc" class="form-control">
                    <option value="tls" {{$data->smtp_enc == 'tls' ? 'selected' : ''}}>tls</option>
                    <option value="ssl"  {{$data->smtp_enc == 'ssl' ? 'selected' : ''}}>ssl</option>
                </select>
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">From Email</label>
                <input class="form-control" type="text" value="{{$data->from_email}}"  name="from_email">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Email Send From Name</label>
                <input class="form-control" type="text" value="{{$data->from_name}}"  name="from_name">
            </div>


            <div class="col-lg-6 mt-2">
                <label class="form-label">From Security</label>
                <input class="form-control" type="text" value="{{$data->from_security}}"  name="from_security">
            </div>

            <div class="col-lg-6 mt-2">
                <label class="form-label">Zerobounce Api</label>
                <input class="form-control" type="text" value="{{$data->zerobounce_api}}"  name="zerobounce_api">
            </div>


            <div class="col-lg-6 mt-2">
                <label class="form-label">Zerobounce Api Check</label>
                <select name="zerobounce_check" class="form-control">
                    <option>--select--</option>
                    <option {{$data->zerobounce_check == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
                    <option {{$data->zerobounce_check == 'no' ? 'selected' : ''}} value="no">No</option>
                </select>
            </div>

    			<div class="col-lg-6">
    			<button class="btn btn-success btn-block" style="margin-top: 33px">Save Changes</button>


    		</div>

    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(function(){
	    @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get("success")}}',


  confirmButtonText: 'Ok'
})
             @endif

})
</script>
