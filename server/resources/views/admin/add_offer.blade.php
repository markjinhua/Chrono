@extends('admin.admin_layouts.header')
@extends('admin.admin_layouts.sidebar')
@extends('admin.admin_layouts.footer')
@section('content')
 
 	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
 

<!-- Latest compiled and minified JavaScript -->

            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card radius-10">
                            	<div class="card-header">
                            			<h4>{{isset($data[0])?'Update':'Add'}} Offer</h4>
                            		  
                            	</div>

                            		                         	<div class="card-body">
   <?php 
if(isset($data[0])){
 $action=url('admin/update-offer');
 
}else{
$action=url('admin/insert-offer');
  
  }
 ?>
<form action="{{$action}}" method="post" enctype="multipart/form-data">
	@csrf
<input type="hidden" name="id" value="{{@$data[0]->offerid}}">
<input type="hidden" name="hidden_preview_image" value="{{@$data[0]->preview_url}}">
<input type="hidden" name="hidden_icon_image" value="{{@$data[0]->icon_url}}">
	<div class="container  ">
		 
<div class="row form-group">
	<div class="col-lg-2">
		<label>Offer Name</label>
	</div>
	<div class="col-lg-8">
		<input type="text" name="offer_name" class="form-control" value="{{@$data[0]->offer_name}}" required="">
	</div>
</div>
<div class="row mt-4 form-group">
		<div class="col-lg-2">
		<label>Advertiser</label>
	</div>
	<div class="col-lg-8">

		<select type="text" name="advertiser_id" class="form-control"  required="">
				<option value="">Select Advertiser</option>
		 
				<?php 
		$qry=DB::table('advertisers')->get();
		foreach($qry as $q){
			?>
  			<option value="{{$q->id}}" {{isset($data[0])?$data[0]->advertiser_id==$q->id?'selected':null:null}}>{{$q->advertiser_name}}</option>
		<?php }?>

		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-lg-2">
		<label>Advertiser Offer Id</label>
	</div>
	<div class="col-lg-8">

		<input type="text" name="advertiser_offer_id" value="{{@$data[0]->advertiser_officer_id}}" class="form-control"  >
	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
		 
		<label>Tracking Domain</label>
	</div>
	<div class="col-lg-8">

		<select type="text" name="tracking_domain_id" class="form-control"  required="">
			<option value="">Select Tracking Domain</option>
			<?php 
		$qry=DB::table('domain')->where('is_deleted','0')->get();
		foreach($qry as $q){?>
 <option value="{{$q->id}}" {{isset($data[0])?$data[0]->tracking_domain_id==$q->id?'selected':null:null}}>{{$q->domain_name}}</option>
 
  <?php }
  ?>
		</select>
	</div>
</div>
<div class="row form-group">

	<div class="col-lg-2">
		<label>Follow</label>
		</div>
	<div class="col-lg-8">
	
		<input type="radio" name="verticals" value="Pay Per Lead" required="" {{isset($data[0])?$data[0]->verticals=='Pay Per Lead'?'checked':null:null}}> Pay Per Lead
		
		<input type="radio" name="verticals" value="Pay Per Acquisition" required="" {{isset($data[0])?$data[0]->verticals=='Pay Per Action'?'checked':null:null}}> Pay Per Action/Acquisition 
		<input type="radio" name="verticals" value="Video Play" required="" {{isset($data[0])?$data[0]->verticals=='Video Play'?'checked':null:null}}> Video Play 
		<input type="radio" name="verticals" value="Pay Per Click" required="" {{isset($data[0])?$data[0]->verticals=='Pay Per Click'?'checked':null:null}}> Pay Per Click 
		
				<input type="radio" name="verticals" value="Pay Per Sale" {{isset($data[0])?$data[0]->verticals=='Pay Per Sale'?'checked':null:null}}> Pay Per Sale
						<input type="radio" name="verticals" value="Pay Per Install" {{isset($data[0])?$data[0]->verticals=='Pay Per Install'?'checked':null:null}}> Pay Per Install
	</div>
</div>
<div class="row form-group">
	<div class="col-lg-2">
		 	<label>Verticals/Category</label>
		</div>
	<div class="col-lg-8">
		
			<select type="text" name="category_id" class="form-control"  required=""> 
			<option value="">Select Category</option>
			<?php 
		$qry=DB::table('category')->where('is_deleted','0')->get();
		foreach($qry as $q){?>
 <option value="{{$q->id}}" {{isset($data[0])?$data[0]->category_id==$q->id?'selected':null:null}}>{{$q->category_name}}</option>
 
  <?php }
  ?>		</select>
	</div>
</div> 
<div class="row form-group">
	<div class="col-lg-2">
		<label>Description</label>
	</div>
	<div class="col-lg-8">

		<textarea name="description"  id="description" class="form-control" value="{{@$data[0]->description}}" required="">{{@$data[0]->description}}</textarea>
	</div>
</div>

<div class="row form-group">
	<div class="col-lg-2">
		<label>Restrications</label>
		</div>
	<div class="col-lg-8">

	<textarea name="requirements" id="requirements" class="form-control" value="{{@$data[0]->requirements}}" required="">{{@$data[0]->requirements}}</textarea>
	</div>
</div>

<div class="row form-group">
	<div class="col-lg-2">
		<label>Tracking Link</label>
		</div>
	<div class="col-lg-8">
		
		
		<input type="text" name="link" class="form-control" value="{{@$data[0]->link}}" required="">
	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
			<label>Upload Preview Photo</label>
		</div>
		
	<div class="col-lg-8">
	
	
		<input type="file" name="preview_link"   class="form-control">
	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
			<label>Preview Link</label>
		</div>
		
	<div class="col-lg-8">
	
	
		<input type="text" name="preview_url"   class="form-control">
	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
			<label>Upload Icon</label>
		</div>
		
	<div class="col-lg-8">
	
		<input type="file" name="icon_url"  class="form-control">
	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
				<label>Lead Quantity / Capping (0=unlimited)</label>
		</div>
	<div class="col-lg-8">
	
		<input type="number " name="lead_qty" value="{{@$data[0]->lead_qty}}" class="form-control">
	</div>
</div>

<div class="row form-group">
	<div class="col-lg-2">
		<label>Custom Payout Percentage </label>
	</div>
 
	<div class="col-lg-4">
		
	<input type="number" id="payout_percentage" name="payout_percentage" value="{{@$data[0]->payout_percentage}}" class="form-control" >
	</div>
	
</div><div class="row form-group">
	<div class="col-lg-2">
		<label>Payout Type </label>
	</div>
	<div class="col-lg-4">
		
		<select   name="payout" class="form-control" id="payout" required="">
			<option value="fixed" {{isset($data[0])?$data[0]->payout_type=='fixed'?'selected':null:null}}>Fixed</option>
			<option value="revshare" {{isset($data[0])?$data[0]->payout_type=='revshare'?'selected':null:null}}>RevShare</option>
		</select>
	</div>
	<div class="col-lg-4">
		
	<input type="text" id="payout_amount" name="payout_amount" value="{{@$data[0]->payout}}" class="form-control" >
	</div>

</div>
<div class="row form-group">
	<div class="col-lg-2">
		<label> Allowed Countries</label>
	</div>

	<div class="col-lg-8">
		
	<select class="js-example-basic-multiple" name="countries[]" multiple="multiple" style="width: 100%" required=""> 

				<?php 
		$qry=DB::table('countries')->get();
		if(isset($data[0])){
		$country_name=explode('|',$data[0]->countries);
	}
		foreach($qry as $q){
			?>
  			<option value="{{$q->country_name}}" {{isset($data[0])?in_array($q->country_name,$country_name)?'selected':null:null}}>{{$q->country_name}}</option>
		<?php }?>

</select>

	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
				<label>Status</label>
		</div>
	<div class="col-lg-8">
	
		<select type="text" name="status" class="form-control">
			<option value="Inactive"  {{isset($data[0])?$data[0]->status=='Inactive'?'selected':null:null}}>Inactive</option>
			<option value="Active"  {{isset($data[0])?$data[0]->status=='Active'?'selected':null:null}} >Active</option>
		</select>
	</div>
</div>
<div class="row form-group">
		<div class="col-lg-2">
				<label>Offer Type</label>
		</div>
	<div class="col-lg-8">
	
		<select type="text" name="offer_type" class="form-control" >
			<option value="public"  {{isset($data[0])?$data[0]->offer_type=='public'?'selected':null:null}}>Public</option>
			<option value="private"  {{isset($data[0])?$data[0]->offer_type=='private'?'selected':null:null}}>Private</option>
			<option value="special"  {{isset($data[0])?$data[0]->offer_type=='special'?'selected':null:null}}>Special</option>
		</select>
	</div>
</div>
<div class="row form-group divhide d-none">
		<div class="col-lg-2">
			<label>Publishers</label>
		</div>

	<div class="col-lg-8">
			 
	<select class="selectpicker" id="publishers" name="publishers[]" multiple data-actions-box="true">
		<?php 
		if(isset($data[0])){
				
		$publisher_id=explode(',',$data[0]->publisher_id);
 }
		$qry=DB::table('publishers')->where('status','Active')->get();

		foreach($qry as $q){?>
 <option value="{{$q->id}}"  {{isset($data[0])?in_array($q->id,$publisher_id)?'selected':null:null}}>{{$q->name}}</option>
 
  <?php }
  ?>
 </select>
	</div>
</div> 
<div class="row form-group">
		<div class="col-lg-2">
			<label> Device/UA Target</label>
		</div>

	<div class="col-lg-8">

	<select class="selectpicker" name="ua_target[]" multiple data-actions-box="true" required="">
<?php if(isset($data[0])){
				
		$ua=explode('|',$data[0]->ua_target);
 }
				?>
				 <option value="Windows"   {{isset($data[0])?in_array('Windows',$ua)?'selected':null:null}}>Windows</option>
 <option value="Android"  {{isset($data[0])?in_array('Android',$ua)?'selected':null:null}}>Android</option>
 <option value="Iphone"  {{isset($data[0])?in_array('Iphone',$ua)?'selected':null:null}}>Iphone</option>
 <option value="Ipad"  {{isset($data[0])?in_array('Ipad',$ua)?'selected':null:null}}>Ipad</option>
 <option value="Mac"  {{isset($data[0])?in_array('Mac',$ua)?'selected':null:null}}>Mac</option>

 </select>
	</div>
</div>

<div class="row form-group">
		<div class="col-lg-2">
			<label>Allowed Browsers</label>
		</div>

	<div class="col-lg-8">

	<select class="selectpicker" name="browser[]" multiple data-actions-box="true" required="">
<?php if(isset($data[0])){
				
		$ua=explode('|',$data[0]->browsers);
 }
				?>
				 <option value="Firefox"   {{isset($data[0])?in_array('Firefox',$ua)?'selected':null:null}}>Firefox</option>
 <option value="Chrome"  {{isset($data[0])?in_array('Chrome',$ua)?'selected':null:null}}>Chrome</option>
 <option value="Safari"  {{isset($data[0])?in_array('Safari',$ua)?'selected':null:null}}>Safari</option>
 <option value="EDGE"  {{isset($data[0])?in_array('EDGE',$ua)?'selected':null:null}}>EDGE</option>
 <option value="Internet Explorer"  {{isset($data[0])?in_array('Internet Explorer',$ua)?'selected':null:null}}>Internet Explorer</option>
 <option value="OPERA MINI"  {{isset($data[0])?in_array('OPERA MINI',$ua)?'selected':null:null}}>OPERA MINI</option>
 <option value="Others"  {{isset($data[0])?in_array('Others',$ua)?'selected':null:null}}>Others</option>

 </select>
	</div>
</div>

<!--<div class="row form-group">-->
<!--		<div class="col-lg-2">-->
<!--					<label>Incentive Allowed</label>-->
<!--		</div>-->
<!--	<div class="col-lg-8">-->
	
<!--		<input type="checkbox" name="incentive" value="1" {{isset($data[0])?$data[0]->incentive_allowed==1?'checked':null:null}}>-->
		 
<!--	</div>-->
<!--</div>-->
<div class="row form-group">
		<div class="col-lg-2">
					<label>Smartlink</label>
		</div>
	<div class="col-lg-8">
	
		<input type="checkbox" name="smartlink" value="1"{{isset($data[0])?$data[0]->smartlink==1?'checked':null:null}}>
		 
	</div>
</div>

<!--<div class="row form-group">-->
<!--		<div class="col-lg-2">-->
<!--					<label>Magiclink</label>-->
<!--		</div>-->
<!--	<div class="col-lg-8">-->
	
<!--		<input type="checkbox" name="magiclink" value="1" {{isset($data[0])?$data[0]->magiclink==1?'checked':null:null}}>-->
		 
<!--	</div>-->
<!--</div>-->
<!--<div class="row form-group">-->
<!--		<div class="col-lg-2">-->
<!--					<label>Native</label>-->
<!--		</div>-->
<!--	<div class="col-lg-8">-->
	
<!--		<input type="checkbox" name="native" value="1" {{isset($data[0])?$data[0]->native==1?'checked':null:null}}>-->
		 
<!--	</div>-->
<!--</div>-->
 
 


<div class="row form-group">
	<div class="col-lg-2">
		<label>Clicks</label>
		</div>
	<div class="col-lg-8">
		
		
		<input type="text" name="clicks" class="form-control"  value="{{@$data[0]->clicks}}">
	</div>
</div>
<div class="row form-group">
	<div class="col-lg-2">
		<label>Conversion</label>
		</div>
	<div class="col-lg-8">
		
		
		<input type="text" name="conversion" class="form-control" value="{{@$data[0]->conversion}}">
	</div>
</div>

<div class="row form-group">
	<div class="col-lg-2">
		<label>Featured</label>
		</div>
	<div class="col-lg-8">
		
		
		<input type="checkbox" name="lockers" class="" value="1" {{isset($data[0])?$data[0]->lockers==1?'checked':null:null}}>
	</div>
</div>
<!--<div class="row form-group">-->
<!--		<div class="col-lg-2">-->
<!--				<label>Featured Offer</label>-->
<!--		</div>-->
<!--	<div class="col-lg-8">-->
	
<!--		<input type="checkbox" name="featured_offer" value="1"{{isset($data[0])?$data[0]->featured_offer==1?'checked':null:null}}>-->
		 
<!--	</div>-->
<!--</div>-->
<div class="row form-group">
		<div class="col-lg-12 text-center">
						<input type="submit"  class="btn btn-primary" values="Submit">
		</div>
 
</div></div>

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
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


<!-- Latest compiled and minified JavaScript -->

<?php $site=DB::table('site_settings')->first();?>
 
<script type="text/javascript">

$(function(){
	  $('#description').summernote({height:150});
	    $('#requirements').summernote({height:150});
	 $('.js-example-basic-multiple').select2();
	 
    @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get("success")}}',
 
 
  confirmButtonText: 'Ok'
})
             @endif

             $('#payout').change(function(){
             	if($('#payout').val()=='fixed'){
             		$('#payout_amount').removeAttr('disabled','true');
             			$('#payout_amount').val('');
             	}
             	else{


             			$('#payout_amount').attr('disabled','true');
             			 

             	}
             })
             $('select[name=offer_type]').change(function(e){
             		if($('select[name=offer_type]').val()=='special'){
             					$('.divhide').removeClass('d-none');
             				 

             		}	
             		else{
             				
             					$('.divhide').addClass('d-none');
             					 
             		}
             })
         })
</script>
