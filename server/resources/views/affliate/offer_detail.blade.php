@extends('affliate.affliate_layouts.header')
@extends('affliate.affliate_layouts.sidebar')
@extends('affliate.affliate_layouts.footer')
@section('content')

   <style type="text/css">
   	h4{
   		font-size: 18px!important;
   	}
   	#offer_name{
   		font-size: 20px;
   	}
   		#offer_name1{
   		font-size: 16px;
   		color:#384A50;
   	}
   </style> 
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card radius-10">
                            	<div class="card-header">
									<h5 class="mb-0">OFFER ID : <span class="text-danger">{{$qry->oid}}</span></h5>
								</div>
                                <div class="card-body">
                                	<h6>Offer Details of <b style="color:#800000">{{$qry->offer_name}}</b></h6>
@if(($qry->offer_type=='public' || $qry->offer_type=='special') )

 
<?php
$count=1;
if($qry->offer_type=='special'){
	$count=DB::table('offers_publisher')->where('publisher_id',Auth::guard('publisher')->id())->where('offer_id',$qry->oid)->count();
}
if($count>0){?>


					<h4><b>Preview Image</b></h4>

					<div class="alert alert-primary" role="alert" style="height: auto;width: fit-content;">
                                                <img src="{{asset('uploads')}}/{{$qry->preview_url}}" style="height:256px;width:256px;object-fit: fill">
                                            </div>	
                                            <a href="{{url('uploads')}}/{{$qry->preview_url}}" class="btn btn-success" target='blank'>Preview Image</a>
                                              @if($qry->preview_link!='')
                                              <a href=" {{$qry->preview_url}}" class="btn btn-success" target='blank'>Preview Link</a>
                                              @endif
<div class="mt-3">
              <h4><b>Offer Name</b></h4>
	<div class="alert alert-primary " role="alert" style="height: auto;width:100%;">
		<span id="offer_name">{{$qry->offer_name}}</span>
	</div>
</div>

<div class="mt-3">
              <h4><b>Offer Details</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name">{!!$qry->description!!}</span>
	</div>
</div>

 

<div class="mt-3">
              <h4><b>Offer Requirements</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name">{!!$qry->requirements!!}</span>
	</div>
</div>

<div class="mt-3">
              <h4><b>Offer Payout</b></h4>
	<div class="alert alert-primary" role="alert" style="height: auto;width:100%;">
	
	<?php if($qry->payout_type=='revshare'){?>

		<span id="offer_name">RevShare</span>
      <?php }else{
?>

<span id="offer_name"> ${{round(($qry->payout*$qry->payout_percentage)/100,2)}}</span>

<?php      } ?>
	
	</div>
	
</div>
<div class="mt-3">
              <h4><b>Supported Only</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">	<?php  $device=explode('|',$qry->ua_target);
	foreach($device as $d){
                                		
                                				?>
                                				@if($d=='Windows')

                                				<i class="lni lni-windows" title="Windows"></i>
 												@elseif($d=='Mac')
 											<i class="fadeIn animated bx bx-laptop" title="Mac"></i>
 												@elseif($d=='Iphone')
 													<i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
 												@elseif($d=='Ipad')
 												<i class="lni lni-tab" title="Ipad"></i>
 												@elseif($d=='Android')
 												<i class="fadeIn animated bx bx-mobile" title="Android"></i>
 												@endif
<?php }?>
		 </span>
	</div>
</div>


<div class="mt-3">
              <h4><b>Offer Category</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">{{$qry->category_name}}</span>
	</div>
</div>
<div class="mt-3">
              <h4><b>Offer Country</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">{{$qry->countries}}</span>
	</div>
</div>
<?php }
else{
echo "You are not allowed to see this offer";
}?>
@endif


                                	@if($qry->offer_type=='private')

                                		 <?php

$q=DB::table('approval_request')->where('offer_id',$qry->oid)->where('publisher_id',Auth::guard('publisher')->id())->first();
 
                                       
                                        if(@$q->approval_status=='Requested'){
                                          ?>
                                        

                                          <h4 class="text-danger">Offer Requested</h4>

                                          <?php
                                        }else if(@$q->approval_status=='Rejected'){

                                         ?>
 
                                         <?php
                                       }
                                   if($q==''){

                                          ?>
                                         
                                          <button class="btn btn-danger" id="request" >Request Approval</button>
 
 <?php 
}
?>
    
                                 			<h4><b>Preview Image</b></h4>

					<div class="alert alert-primary" role="alert" style="height: auto;width: fit-content;">
                                                <img src="{{asset('uploads')}}/{{$qry->preview_url}}" style="height:256px;width:256px;object-fit: fill">
                                            </div>
                                    	
                                      <div>
                                            <a href="{{url('uploads')}}/{{$qry->preview_url}}" class="btn btn-success" target='blank'>Preview Image</a>
                                        
                                          </div>
                                            

<div class="mt-3">
              <h4><b>Offer Name</b></h4>
	<div class="alert alert-primary " role="alert" style="height: auto;width:100%;">
		<span id="offer_name">{{$qry->offer_name}}</span>
	</div>
</div>

<div class="mt-3">
              <h4><b>Offer Details</b></h4>
	<div class="alert border" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">{!!$qry->description!!}</span>
	</div>
</div>

 

<div class="mt-3">
              <h4><b>Offer Requirements</b></h4>
	<div class="alert border" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">{!!$qry->requirements!!}</span>
	</div>
</div>
<?php   if(@$q->approval_status=='Approved'){?>
<?php if($qry->smartlink!=1){?>
<div class="col-lg-3">
         <select class="form-control" id="domain" name="domain">
                 <?php 
$domain=DB::table('domain')->get();
                 ?>
                 <option value="">Select Domain</option>
                @foreach($domain as $q)
                <option value="{{$q->domain_name}}">{{$q->domain_name}}</option>
                @endforeach
             </select>
</div>
<div class="mt-5 mb-5">
              <h4><b>Tracking</b></h4>
              <hr>
              <p class="text-danger" id="offer_name1">If you want to use Sub Affliate then enter the value. Otherwise do not enter anything.You can use one or one more sub id</p>
              <table class="table">
              	<thead>
               
              		<th>Enter SubID1</th>
              		<th>Enter SubID2</th>
              		<th>Enter SubID3</th>
              		<th>Enter SubID4</th>
              		<th>Enter SubID5</th>

              	</thead>
              	<tr>
        
              	<td><input class="form-control" type="text" id="myInput" oninput="sid1()"></td>
<td><input class="form-control" type="text" id="myInput2" oninput="sid2()"></td>
<td><input class="form-control" type="text" id="myInput3" oninput="sid3()"></td>
<td><input class="form-control" type="text" id="myInput4" oninput="sid4()"></td>
<td><input class="form-control" type="text" id="myInput5" oninput="sid5()"></td>
              	</tr>
              </table>
                 <p class="text-danger" id="offer_name1">
              Copy the link from blew
          </p>
          </div>
 <?php 
 
                 ?>
<div class="mt-3">
              <h4><b>Offer Link</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name"><span id="url">{{@$domain[0]->domain_name}}</span>/click?camp={{$qry->oid}}&pubid={{Auth::guard('publisher')->id()}}<span id="sid"></span><span id="sid2"></span><span id="sid3"></span><span id="sid4"></span><span id="sid5"></span></span>
	</div>
</div>
 
  <?php } } ?>

<div class="mt-3">
              <h4><b>Offer Payout</b></h4>
	<div class="alert alert-primary" role="alert" style="height: auto;width:100%;">
    <?php if($qry->payout_type=='revshare'){?>

		<span id="offer_name">RevShare</span>
      <?php }else{
?>

<span id="offer_name"> ${{round(($qry->payout*$qry->payout_percentage)/100,2)}}</span>

<?php      } ?>
	</div>
</div>
<div class="mt-3">
              <h4><b>Supported Only</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">	<?php  $device=explode('|',$qry->ua_target);
	foreach($device as $d){
                                		
                                				?>
                                				@if($d=='Windows')

                                				<i class="lni lni-windows" title="Windows"></i>
 												@elseif($d=='Mac')
 											<i class="fadeIn animated bx bx-laptop" title="Mac"></i>
 												@elseif($d=='Iphone')
 													<i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
 												@elseif($d=='Ipad')
 												<i class="lni lni-tab" title="Ipad"></i>
 												@elseif($d=='Android')
 												<i class="fadeIn animated bx bx-mobile" title="Android"></i>
 												@endif
<?php }?>
		 </span>
	</div>
</div>


<div class="mt-3">
              <h4><b>Offer Category</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">{{$qry->category_name}}</span>
	</div>
</div>
<div class="mt-3">
              <h4><b>Offer Country</b></h4>
	<div class="alert alert-success" role="alert" style="height: auto;width:100%;">
		<span id="offer_name1">{{$qry->countries}}</span>
	</div>
</div>

 
        
@endif
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-- Edit MODAL -->

<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="form2">
      			@csrf
      
    	<div class="row">
     		<div class="col-lg-12 form-group">
     			<label >HOW ARE YOU PLANNING TO PROMOTE THIS OFFER</label>
 		 		<textarea type="text" name="description" class="form-control" rows=5></textarea>
 		 	</div>
 		 	<div class="col-lg-12 form-group mt-2">
     			 
 		 		<input   type="checkbox" name="terms" checked="true" class="form-cotrol" >
 		 			<label>AGREE WITH TERMS AND CONDITIONS OF THIS OFFER</label>
 		 	</div>
 </div>
 </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnUpdate">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Edit MODAL -->
            <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
            <script>
	
  
function sid1() {
  var x = document.getElementById("myInput").value;
  document.getElementById("sid").innerHTML = "&sid=" + x;
}
function sid2() {
  var x2 = document.getElementById("myInput2").value;
  document.getElementById("sid2").innerHTML = "&sid2=" + x2;
}
  function sid3() {
  var x3 = document.getElementById("myInput3").value;
  document.getElementById("sid3").innerHTML = "&sid3=" + x3;
}
  function sid4() {
  var x4 = document.getElementById("myInput4").value;
  document.getElementById("sid4").innerHTML = "&sid4=" + x4;
}
  function sid5() {
  var x5 = document.getElementById("myInput5").value;
  document.getElementById("sid5").innerHTML = "&sid5=" + x5 ;

  
}
$(function(){
 $('#domain').change(function(){
       
            $('#url').html($('#domain').val());
           

    })
 $('#request').click(function(){
$('#editModal').modal('show');
 	
 })

 })
</script>

      @endsection('content')
         