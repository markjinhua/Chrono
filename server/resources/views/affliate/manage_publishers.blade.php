@extends('affliate.affliate_layouts.header')
@extends('affliate.affliate_layouts.sidebar')
@extends('affliate.affliate_layouts.footer')
@section('content')

   

      
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card radius-10">
                              <div class="card-header">

            <h4>Manage  Publisher </h4>
         
                              </div>
                                <div class="card-body">
 
    	 
    		<div class="row">
    		

    	
    		<div class="col-lg-12 table-responsive">
       <table   width="100%" id="example" class="table table-sm table-bordered table-striped">
	<thead>
		<tr>
			<th>Id</th>
       <th>Image</th> 
	   <th>Name</th> 
			<th>Email</th>

<th>Date Joined</th>

  <th>Total Clicks</th>
    <th>Total Unique Clicks</th>
      <th>Total Conversion</th>
    <th>Total Revenue</th>
      <th>Total Proxy Clicks</th>

			<th>Status</th>
	  
			<th>Action</th>
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
	url:'<?php echo url('affliate/show-publisher')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 		 
 			 	  var total_earnings=0;
 			 	  
 			 if(res[i].total_earnings!=null && res[i].total_earnings!=''){
 			     
 			     total_earnings=parseFloat(res[i].total_earnings).toFixed(2);
 			 }
 			 
 			 
 		html+='<tr>'+
					'<td>'+res[i].id+'</td>'+
				  '<td><img src="{{url('uploads')}}/'+res[i].publisher_image+'" width=100px height=100px></td>'+
						'<td>'+res[i].name+'</td>'+
						 
									'<td>'+res[i].email+'</td>'+
                     
                                '<td>'+res[i].created_at+'</td>'+
                                       '<td>'+res[i].total_clicks+'</td>'+
                             '<td>'+res[i].unique_clicks+'</td>'+
                              '<td>'+res[i].total_leads+'</td>'+
                               '<td>'+total_earnings+'</td>'+
                                '<td>'+res[i].vpn_clicks+'</td>'+

										    '<td>'+res[i].status+'</td>'+
					'<td><div class="dropdown">'+
  '<button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Action'+
  '<span class="caret"></span></button>'+
  '<ul class="dropdown-menu">'+
    '<a href="<?php echo url('affliate/get-detail')?>/'+res[i].id+'" class=" py-3 get_details" data='+res[i].id+'><li class=py-2>Get Details</li> </a>'+
    
     '<a href="<?php echo url('affliate/set-postback')?>/'+res[i].id+'" class=" py-3 " data='+res[i].id+'><li class=py-2>Set Postback</li> </a>'+
    
        '<a href="javascript:;" class=" py-3 ban" data='+res[i].id+'><li class=py-2>BAN</li> </a>'+
     
    
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
$

//EDIT DATA
$('#showdata').on('click','.ban',function(){

let id=$(this).attr('data');
var txt;
var r = confirm("Do you want to BAN this account!");
if (r == true) {
 
 window.location.href='<?php echo url('affliate/ban-publishers')?>/'+id+'';
 
}
})

//EDIT DATA
$('#showdata').on('click','.approve',function(){

let id=$(this).attr('data');
var txt;
var r = confirm("Do you want to Approve this account!");
if (r == true) {
 
 window.location.href='<?php echo url('affliate/approve-publishers')?>/'+id+'';
 
}
})
//EDIT DATA
$('#showdata').on('click','.reject',function(){

let id=$(this).attr('data');
var txt;
var r = confirm("Do you want to Reject this account!");
if (r == true) {
 
 window.location.href='<?php echo url('affliate/reject-publishers')?>/'+id+'';
 
}
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
