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
                                <h4>Manage Publishers</h4>
  </div>
  <div class="card-body">



    		<div class="row">

<div class="col-lg-12 text-right mb-4  mt-2">
            <button class="btn btn-primary"  data-toggle="modal" data-target="#addModal">Create New Publisher</button>
        </div>


    		<div class="col-lg-12 table-responsive ">
    	<table id="datatable" class="table table">
	<thead>
		<tr>
			<td>Id</td>
	 <td>Name</td>
			<td>Email</td>
			<td>Status</td>
<td>Date Joined</td>
 <td>Vpn Clicks</td>
<td>Unique Clicks</td>
<td>Total Clicks</td>
<td>Conversions</td>
<!--<td>Earnings</td>-->

			<td>Action</td>
		</tr>
	</thead>
	<tbody id="showdata">

	</tbody>
</table>


<!-- ADD MODAL -->
<form   action="{{url('admin/insert-publishers')}}" method="post" enctype="multipart/form-data">
      			@csrf
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add  Publisher </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

     	<div class="row">

 		 		<div  class="col-lg-6 form-group">
     			<label > Publisher Name</label>
     				<input type="text" name="name" class="form-control" required="">
     		</div>
     		<div  class="col-lg-6 form-group">
     			<label > Email</label>
     				<input type="email" name="email" class="form-control" required="">
     		</div>
     			<div  class="col-lg-6 form-group">
     			<label > Password</label>
     				<input type="text" name="password" class="form-control" required="">
     		</div>
          <div  class="col-lg-6 form-group">
          <label >Confirm password</label>
            <input type="text" name="confirm_password" class="form-control" required="">
        </div>
          <div  class="col-lg-6 form-group">
          <label > Address</label>
            <input type="text" name="address" class="form-control" >
        </div>
           <div  class="col-lg-6 form-group">
                  <label class="form-label">Countries</label>

  <select class="form-control" name="countries"style="width: 100%" >
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
          <div  class="col-lg-6  form-group">
          <label > City</label>
            <input type="text" name="city" class="form-control" >
        </div>
        <div  class="col-lg-6  form-group">
          <label > Region</label>
            <input type="text" name="region" class="form-control" >
        </div>

        <div  class="col-lg-6  form-group">
          <label > Account Status</label>
            <select type="text" name="status" id="status"  class="form-control" required="">

      <option value="Inactive"   >Inactive</option>
      <option value="Active"   >Active</option>
    </select>
        </div>


        <div class="col-lg-6  form-group">
            <label class="form-label"> When Publishers will get Paid?</label>

            <select type="text" name="default_payment_terms" class="form-control"  required="">
                <option  value="net45">Every 45 Days</option>
                <option  value="net30">Monthly</option>
                <option  value="net15">Every 15 days</option>
                <option  value="netweekly">Weekly</option>
             </select>

        </div>


         <div  class="col-lg-6  form-group">
          <label > Affliate Manager</label>
             <select type="text" name="affliate_manager" class="form-control"  required="">
      <option value="">Select Affliate Manager</option>
      <?php
    $qry=DB::table('affliates')->get();
    foreach($qry as $q){?>
 <option value="{{$q->id}}"  >{{$q->name}}</option>

  <?php }
  ?>
    </select>
        </div>

                <div  class="col-lg-6  form-group">
          <label > Photo</label>
            <input type="file" name="photo" class="form-control" >
        </div>



 </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 </form>
<!-- End ADD MODAL -->



<!-- Edit MODAL -->
<form action="{{url('admin/update-publishers')}}" method="post" enctype="multipart/form-data">
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Edit Publisher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      			@csrf
       <input type="hidden" id="id" name="id">
        <input type="hidden" id="hidden_img" name="hidden_img">
 			<div class="row">

      <div  class="col-lg-6 form-group">
          <label > Publisher Name</label>
            <input type="text" name="name1" class="form-control" required="">
        </div>
        <div  class="col-lg-6 form-group">
          <label > Email</label>
            <input type="email" name="email1" class="form-control" required="">
        </div>

          <div  class="col-lg-6 form-group">
          <label > Address</label>
            <input type="text" name="address1" class="form-control" >
        </div>
           <div  class="col-lg-6 form-group">
                  <label class="form-label">Countries</label>

  <select class="form-control" name="countries1"style="width: 100%" >
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
          <div  class="col-lg-6  form-group">
          <label > City</label>
            <input type="text" name="city1" class="form-control" >
        </div>
        <div  class="col-lg-6  form-group">
          <label > Region</label>
            <input type="text" name="region1" class="form-control" >
        </div>

        <div  class="col-lg-6  form-group">
          <label > Account Status</label>
            <select type="text" name="status1" id="status1"  class="form-control" required="">

      <option value="Inactive"   >Inactive</option>
      <option value="Active"   >Active</option>
    </select>
        </div>
         <div  class="col-lg-6  form-group">
          <label > Affliate Manager</label>
             <select type="text" name="affliate_manager1" class="form-control"  required="">
      <option value="">Select Affliate Manager</option>
      <?php
    $qry=DB::table('affliates')->get();
    foreach($qry as $q){?>
 <option value="{{$q->id}}"  >{{$q->name}}</option>

  <?php }
  ?>
    </select>
        </div>

                <div  class="col-lg-6  form-group">
          <label > Photo</label>
            <input type="file" name="photo1" class="form-control" >
        </div>
  <div  class="col-lg-6  form-group">
          <label > Previous Image</label>

          <a id="publisher_image_anchor" target="_blank"><img width="70px" height="100px" id="publisher_image"></a>
        </div>


 			</div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 </form>
<!-- End Edit MODAL -->

<!-- Delete MODAL -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete  Publisher Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do You want to delete this Publisher Request.
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
</div>
</div>
</div>
</div>

@endsection('content')
<!-- ADD Publisher Request Modal -->
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


showdata();
function showdata(){
$.ajax({
	method:'get',
	url:'<?php echo url('admin/show-publishers')?>',
	async:false,
	dataType:'json',
	success:function(res){

 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
if(res[i].total_clicks==0){
conversion=0;
}
else{
  conversion=parseFloat(res[i].total_leads/res[i].total_clicks*100).toFixed(2);
}
var earnings=0;
if(res[i].total_earnings!=null){
    earnings=parseFloat(res[i].total_earnings).toFixed(2)
}

 		html+='<tr>'+
					'<td>'+res[i].id+'</td>'+
				  '<td>'+res[i].name+'</td>'+
						'<td>'+res[i].email+'</td>'+

									'<td>'+res[i].status+'</td>'+

                     '<td>'+res[i].created_at+'</td>'+
                      '<td>'+res[i].vpn_clicks+'</td>'+
                       '<td>'+res[i].unique_clicks+'</td>'+
                       '<td>'+res[i].total_clicks+'</td>'+
                       '<td>'+conversion+'%</td>'+

										  //'<td>'+earnings+'</td>'+

					'<td><div class="dropdown">'+
  '<button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Action'+
  '<span class="caret"></span></button>'+
  '<ul class="dropdown-menu">'+
    '<a href="{{url('admin/edit-view-publisher')}}/'+res[i].id+'" class=" py-3" data='+res[i].id+'><li class=py-2>Edit</li> </a>'+
     '<a href="{{url('admin/access-publisher')}}/'+res[i].email+'" target=_blank class=" py-3" data='+res[i].id+'><li class=py-2>Access Account</li> </a>'+
    '<a  href="javascript:;" class="text-danger deleteData" data='+res[i].id+'><li class=py-2>Delete</li></a>'+
    '<a href="javascript:;" class=" py-3 ban" data='+res[i].id+'><li class=py-2>BAN</li> </a>'+
    ' '+
  '</ul>'+
'</div></td>'

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
//EDIT DATA
$('#showdata').on('click','.ban',function(){

let id=$(this).attr('data');
var txt;
var r = confirm("Do you want to BAN this account!");
if (r == true) {

 window.location.href='<?php echo url('admin/ban-publishers')?>/'+id+'';

}
})

//EDIT DATA
$('#showdata').on('click','.editData',function(){

let id=$(this).attr('data');

$.ajax({
	method:'get',
	data:{id:id},
	url:'<?php echo url('admin/edit-publishers')?>',
	async:false,
	dataType:'json',
	success:function(res){
		 $('#editModal').modal('show');

				$('input[name=name1]').val(res.name);
        $('input[name=email1]').val(res.email);
        $('input[name=address1]').val(res.address);
        $('input[name=city1]').val(res.city);

        $('input[name=region1]').val(res.region);
        $('select[name=status1]').val(res.status);
         $('select[name=affliate_manager1]').val(res.affliate_manager_id);
        $('select[name=countries1]').val(res.country);
$('input[name=hidden_img]').val(res.publisher_image);
 $('#publisher_image').attr('src','<?php echo asset('uploads/')?>/'+res.publisher_image+'')
  $('#publisher_image_anchor').attr('href','<?php echo asset('uploads/')?>/'+res.publisher_image+'')
			$('#id').val(res.id);
		},
})
})

//EDIT DATA
$('#showdata').on('click','.deleteData',function(){
$('#deleteModal').modal('show');
let id=$(this).attr('data');
$('#btnDelete').unbind().click(function(){
$.ajax({
	method:'get',
	data:{id:id},
	url:'<?php echo url('admin/delete-publishers')?>',
	async:false,
	dataType:'json',
	success:function(res){
		 $('#deleteModal').modal('hide');
showdata();
		},


});

})
})


});
</script>
