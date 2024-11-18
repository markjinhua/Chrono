@extends('admin.admin_layouts.header')
@extends('admin.admin_layouts.sidebar')
@extends('admin.admin_layouts.footer')
@section('content')
 	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card radius-10">
                            	<div class="card-header">
                            		<h4>Approve Offer Process</h4>
  </div>
  <div class="card-body">







    <form action="{{url('admin/lead/search')}}" method="get">
        @csrf
<div class="row">
<div class="col-lg-3">
<label>Offer Name</label>
<input class="form-control" placeholder="Offer Name" name="offer_name">
</div>
<div class="col-lg-3">
<label>Offer Id</label>
<input class="form-control" placeholder="Offer Id" name="offer_id">
</div>
<div class="col-lg-3">
<label>Ip Address</label>
<input class="form-control" placeholder="Ip Address" name="ip_address">
</div>
<div class="col-lg-3">
<label>Publisher Name</label>
<input class="form-control" placeholder="Publisher Name" name="publisher_name">
</div>
<div class="col-lg-3">
<label>Publisher Email</label>
<input class="form-control" placeholder="Publisher Email" name="publisher_email">
</div>
<div class="col-lg-3">
<label>Hash</label>
<input class="form-control" placeholder="Hash" name="hash">
</div>

<div class="col-lg-3">
<label>Advertiser Name</label>
<input class="form-control" placeholder="Advertiser Name" name="advertiser_name">
</div>


<div class="col-lg-3">
<label class="form-label">Countries</label>

<select class="js-example-basic-multiple" name="countries[]" multiple="multiple" style="width: 100%" >
<option></option>
<?php
$qry=DB::table('countries')->get();
foreach($qry as $q){
?>
<option value="{{$q->country_name}}" >{{$q->country_name}}</option>
<?php }
?>
</select>
</div>
<div class="col-lg-2">
<label class="form-label">Targeting</label>

<select class="selectpicker w-100" name="ua_target[]" id="ua_target" multiple data-actions-box="true"  >

<option value="Windows"  >Windows</option>
<option value="Android" >Android</option>
<option value="Iphone"  >Iphone</option>
<option value="Ipad" >Ipad</option>
<option value="Mac"  >Mac</option>

</select>  </div>
<div class="col-lg-2">
<label class="form-label">Browsers</label>

<select class="selectpicker w-100" name="browser[]" multiple data-actions-box="true">
<?php if(isset($data[0])){

$ua=explode('|',$data[0]->browsers);
}
?>
<option value="Firefox" >Firefox</option>
<option value="Chrome"  >Chrome</option>
<option value="Safari"  >Safari</option>
<option value="EDGE" >EDGE</option>
<option value="Internet Explorer">Internet Explorer</option>
<option value="OPERA MINI"  >OPERA MINI</option>
<option value="Others" >Others</option>

</select>
</div>
<div class="col-lg-8">
<button class="btn btn-primary" type="submit" style="margin-top: 31px;" >Filter</button>

           <div class="btn-group"  style="margin-top: 29px">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Wait</button>
    <div class="dropdown-menu">
         <a class="dropdown-item waitingSelected" id="waitingSelected"   type="button">Mark Waiting Selected</a>
            <a class="dropdown-item waitAll" id="waitAll"  type="button">Wait All</a>


        </div></div>
           <div class="btn-group"  style="margin-top: 29px">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reject Selected</button>
    <div class="dropdown-menu">

      <a class="dropdown-item rejectSelected"  id="rejectSelected" type="button" >Reject Selected</a>

          </div></div>
               <div class="btn-group"  style="margin-top: 29px">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reject All</button>
    <div class="dropdown-menu">


<a class="dropdown-item rejectAll"  id="rejectAll"  type="button">Reject All</a>
          </div></div>


            <div class="btn-group"  style="margin-top: 29px">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Approve Selected</button>
    <div class="dropdown-menu">
      <a  class="dropdown-item approveSelected" id="approveSelected"   type="button">Approve Selected</a>



        </div></div>
           <div class="btn-group"  style="margin-top: 29px">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Approve All</button>
    <div class="dropdown-menu">

       <a class="dropdown-item approveAll"  id="approveAll"  type="button">Approve All</a>



        </div></div>


  </div>
</div>
<input type="hidden" name="status" value="Approved">
</form>










 <div class="row">

    			<div class="col-lg-12 mt-3  table-responsive">

    				<table class="table table-sm  ">
    					<thead>
    					<tr>
                <td></td>

    			   <td>Advertiser Offer Id</td>

      <td>Offer Name</td>
      <td>Ip Address</td>
      <td>Ip Score</td>
<td>Date</td>
<td>Publisher ID</td>
      <td>Publisher Name</td>
       <td>Publisher Email</td>
       <td>Payout</td>
        <td>Advertiser Name</td>
         <td>Hash Key</td>
          <td>Country</td>
             <td>Browser</td>
<td>UA Target</td>
          <td>Unique</td>
           <td>Status</td>
         </tr>
    				</thead>
            <form id="form">
              @csrf
    				<tbody  class="text-dark">

              @foreach($offers as $q)
              <tr>
                <td><input type="checkbox" name="check[]" value="{{$q->id}}"></td>

                <td>{{$q->advertiser_offer_id}}</td>
                <td>{{$q->offer_name}}</td>
                <td>{{$q->ip_address}}</td>
                <td></td>
                <td>{{$q->created_at}}</td>
                <td>{{$q->publisher_id}}</td>
                <td>{{$q->publisher_name}}</td>
                <td>{{$q->publisher_email}}</td>
                <td>{{$q->payout}}</td>
                <td>{{$q->advertiser_name}}</td>
                <td>{{$q->code}}</td>
                <td>{{$q->country}}</td>
                <td>{{$q->browser}}</td>
                  <td>{{$q->ua_target}}</td>
                    <td>{{$q->unique_}}</td>
                      <td>{{$q->status}}</td>


              </tr>
              @endforeach
    				</tbody>
          </form>
    				</table>

                    {{$offers->appends(Request::all())->links()}}
    			</div>
    		</div>
    	</div>
    </div>

<!-- Delete MODAL -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete  Pending Offer Process</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do You want to delete this Pending Offer Process.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- End Delete MODAL -->
</div>

</div>
</div>
</div>

@endsection('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous" ></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" ></script>


<script type="text/javascript">

	$(function(){
     $('.js-example-basic-multiple').select2();

		$('#datatable').DataTable({'ordering':false,'lengthChange':false,'destroy':true,})

//EDIT DATA
$('#showdata').on('click','.approveSelected',function(){

 var data=$('#form').serialize();

 var searchIDs = $('input:checked').map(function(){

      return $(this).val();

    });

$.ajax({
  method:'get',
  data:{check:searchIDs.get()},
  url:'<?php echo url('admin/approve-pending-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){
    alert('Offer Process Approved successfully');
  searchData();
  },
  error:function(){
    alert('Error');
  }

})
})
$('#rejectSelected').click(function(){

 var data=$('#form').serialize();
console.log(data);
 var searchIDs = $('input:checked').map(function(){

      return $(this).val();

    });

$.ajax({
  method:'get',
  data:{check:searchIDs.get()},
  url:'<?php echo url('admin/approve-reject-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){
    alert('Offer Process Reject successfully');
  searchData();
  },
  error:function(){
    alert('Error');
  }

})
})
$('#showdata').on('click','.waitingSelected',function(){

 var data=$('#form').serialize();
console.log(data);
 var searchIDs = $('input:checked').map(function(){

      return $(this).val();

    });

$.ajax({
  method:'get',
  data:{check:searchIDs.get()},
  url:'<?php echo url('admin/approve-wait-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){
    alert('Offer Process Wait successfully');
  searchData();
  },
  error:function(){
    alert('Error');
  }

})
})
 $('#showdata').on('click','.waitAll',function(){

 var data=$('#form').serialize();
  $("input:checkbox").attr('checked','true');
 var searchIDs = $('input:checked').map(function(){

      return $(this).val();

    });

$.ajax({
  method:'get',
  data:{check:searchIDs.get()},
  url:'<?php echo url('admin/approve-wait-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){
    alert('Offer Process Awaited successfully');
  searchData();
  },
  error:function(){
    alert('Error');
  }

})
})
  $('#showdata').on('click','.approveAll',function(){

 var data=$('#form').serialize();
  $("input:checkbox").attr('checked','true');
 var searchIDs = $('input:checked').map(function(){

      return $(this).val();

    });

$.ajax({
  method:'get',
  data:{check:searchIDs.get()},
  url:'<?php echo url('admin/approve-pending-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){
    alert('Offer Process Approved successfully');
  searchData();
  },
  error:function(){
    alert('Error');
  }

})
})

   $('#rejectAll').click(function(){

 var data=$('#form').serialize();
  $("input:checkbox").attr('checked','true');
 var searchIDs = $('input:checked').map(function(){

      return $(this).val();

    });

$.ajax({
  method:'get',
  data:{check:searchIDs.get()},
  url:'<?php echo url('admin/approve-reject-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){
    alert('Offer Process Rejected successfully');
  searchData();
  },
  error:function(){
    alert('Error');
  }

})
})


$('#search').click(function(){
	searchData();

})
function searchData(){
  var data=$('#form1').serialize();

$.ajax({
  method:'get',
  data:data,
  url:'<?php echo url('admin/search-approve-offer-process')?>',
  async:false,
  dataType:'json',
  success:function(res){

    let html='';
    let sno=0;
    for(var i=0;i<res.length;i++){
      sno++;


    html+='<tr>'+
    '<td><input type="checkbox" name="check[]" value="'+res[i].id+'"></td>'+

          '<td>'+res[i].advertiser_offer_id+'</td>'+
          '<td>'+res[i].offer_name+'</td>'+
          '<td>'+res[i].ip_address+'</td>'+
          '<td></td>'+
          '<td>'+res[i].created_at+'</td>'+
          '<td>'+res[i].publisher_id+'</td>'+
          '<td>'+res[i].publisher_name+'</td>'+
          '<td>'+res[i].publisher_email+'</td>'+
          '<td>'+res[i].payout+'</td>'+
          '<td>'+res[i].advertiser_name+'</td>'+
         '<td>'+res[i].code+'</td>'+
         '<td>'+res[i].country+'</td>'+
         '<td>'+res[i].browser+'</td>'+
         '<td>'+res[i].ua_target+'</td>'+
         '<td>'+res[i].unique_+'</td>'+
         '<td>'+res[i].status+'</td>'+



        +'</tr>';
    }
  $('#datatable').DataTable().destroy();
    $('#showdata').html(html);
      $('#datatable').DataTable({ordering:false}).draw();


  },
  error:function(){
      alert('Error')
  }

})
}
})
</script>
