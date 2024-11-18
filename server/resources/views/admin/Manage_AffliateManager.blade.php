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
                                <h4>Manage Affliate Manager</h4>
  </div>
  <div class="card-body">

    	 
    	 
    		<div class="row">
    		

    	 <div class="col-lg-12 text-right  mt-2 mb-4">
            <button class="btn btn-primary"  data-toggle="modal" data-target="#addModal">Create New Affliate Manager</button>
        </div>
    		<div class="col-lg-12 table-responsive ">
    	<table id="datatable" class="table table">
	<thead>
		<tr>
			<td>Id</td>
        <td>Photo</td>
			<td> Name</td>
		 
			<td>Email</td>
			<td>Skype</td>
			<td>Address</td>
<td>Status</td>
<td>Control Access</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody id="showdata">
		
	</tbody>
</table>


<!-- ADD MODAL --> 
<form   action="{{url('admin/insert-affliatemanager')}}" method="post"  enctype="multipart/form-data">
      			@csrf
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add  Affliate Manager </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
     	<div class="row">
     		    
 		 		<div  class="col-lg-6 form-group">
     			<label > Affliate Manager Name</label>
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
          <div  class="col-lg-6  form-group">
          <label > Skype</label>
            <input type="text" name="skype" class="form-control" >
        </div>
         <div  class="col-lg-6  form-group">
          <label > Photo</label>
            <input type="file" name="photo" class="form-control" >
        </div>
         <div  class="col-lg-12 form-group">
          <label > Address</label>
            <input type="text" name="address" class="form-control" >
        </div>
        <div  class="col-lg-6  form-group">
          <label > Account Status</label>
            <select type="text" name="status" id="status"  class="form-control" required="">
     
      <option value="Inactive"   >Inactive</option>
      <option value="Active"   >Active</option>
    </select>
        </div>  
        
        
        <div  class="col-lg-6  form-group">
          <label > Control Access</label>
            <select type="text" name="power_mode" id="power_mode"  class="form-control" required="">
     
      <option value="0"   >General</option>
      <option value="1"   >Expert</option>
    </select>
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
<form action="{{url('admin/update-affliatemanager')}}" method="post" enctype="multipart/form-data">
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Edit Affliate Manager</h5>
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
          <label > Affliate Manager Name</label>
            <input type="text" name="name1" class="form-control" required="">
        </div>
        <div  class="col-lg-6 form-group">
          <label > Email</label>
            <input type="email" name="email1" class="form-control" required="">
        </div>
         

          <div  class="col-lg-6  form-group">
          <label > Skype</label>
            <input type="text" name="skype1" class="form-control" >
        </div>
          <div  class="col-lg-6  form-group">
          <label > Photo</label>
            <input type="file" name="photo1" class="form-control" >
        </div>
      
         <div  class="col-lg-12 form-group">
          <label > Address</label>
            <input type="text" name="address1" class="form-control" >
        </div>
 			 
 <div  class="col-lg-6  form-group">
          <label > Account Status</label>
            <select type="text" name="status1" id="status1"  class="form-control" required="">
     
      <option value="Inactive"   >Inactive</option>
      <option value="Active"   >Active</option>
    </select>
        </div> 
        
        <div  class="col-lg-6  form-group">
          <label > Control Access</label>
            <select type="text" name="power_mode" id="power_mode"  class="form-control" required="">
     
      <option value="0"   >General</option>
      <option value="1"   >Expert</option>
    </select>
        </div> 

    
  <div  class="col-lg-6  form-group">
          <label > Previous Image</label>

          <a id="publisher_image_anchor" target="_blank"><img width="100px" height="100px" id="publisher_image"></a>
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


</div>
</div>
</div>
</div>
</div>







<!-- Delete MODAL -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete  Affliate Manager Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do You want to delete this Affliate Manager Request.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete MODAL -->

<!-- Edit MODAL -->
<form action="{{url('admin/change-affliatemanager')}}" method="post" enctype="multipart/form-data">
<div id="passwordModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Change Affliate Manager Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
            @csrf
       <input type="hidden" id="passwordid" name="password_id">
           
      <div class="row">
                
        <div  class="col-lg-12 form-group">
          <label >New Password</label>
            <input type="text" name="password" class="form-control" required="">
        </div>
        <div  class="col-lg-12 form-group">
          <label > Confirm Password</label>
            <input type="text" name="confirm_password" class="form-control" required="">
        </div>
 

  </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Change</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 </form>
<!-- End Edit MODAL -->

@endsection('content')
<!-- ADD Affliate Manager Request Modal -->
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
	url:'<?php echo url('admin/show-affliatemanager')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 		 
 		html+='<tr>'+
					'<td>'+res[i].id+'</td>'+
					'<td><img src="<?php echo url('uploads/')?>/'+res[i].photo+'" width=100 height=100></td>'+
          '<td>'+res[i].name+'</td>'+
						'<td>'+res[i].email+'</td>'+
						 
									'<td>'+res[i].skype+'</td>'+
                    '<td>'+res[i].address+'</td>'+
                     '<td>'+res[i].status+'</td>';
                     
        if(res[i].power_mode == "1") {
            html+='<td>Expert</td>';
        } else {
            html+='<td>General</td>';
        }
										 
		html+= '<td><div class="dropdown">'+
  '<button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Action'+
  '<span class="caret"></span></button>'+
  '<ul class="dropdown-menu">'+
    '<a href="javascript:;" class="editData py-3" data='+res[i].id+'><li class=py-2>Edit</li> </a>'+
      '<a href="javascript:;" class="changePassword py-3" data='+res[i].id+'><li class=py-2>Change Password</li> </a>'+
    '<a  href="javascript:;" class="text-danger deleteData" data='+res[i].id+'><li class=py-2>Delete</li></a>'+
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
$('#showdata').on('click','.editData',function(){

let id=$(this).attr('data');
$.ajax({
	method:'get',
	data:{id:id},
	url:'<?php echo url('admin/edit-affliatemanager')?>',
	async:false,
	dataType:'json',
	success:function(res){
	    console.log(res);
		 $('#editModal').modal('show');
				$('input[name=name1]').val(res.name);
        $('input[name=email1]').val(res.email);
        $('input[name=address1]').val(res.address);
           $('[name="status1"]').val(res.status);
        $('input[name=skype1]').val(res.skype);
        $('[name="power_mode"]').val(res.power_mode);
 $('input[name=hidden_img]').val(res.photo);
 $('#publisher_image').attr('src','<?php echo asset('uploads/')?>/'+res.photo+'')
  $('#publisher_image_anchor').attr('href','<?php echo asset('uploads/')?>/'+res.photo+'')
			$('#id').val(res.id);

		},



})
})
$('#showdata').on('click','.changePassword',function(){

let id=$(this).attr('data');
$.ajax({
  method:'get',
  data:{id:id},
  url:'<?php echo url('admin/edit-affliatemanager')?>',
  async:false,
  dataType:'json',
  success:function(res){
     $('#passwordModal').modal('show');
     
      $('#passwordid').val(res.id);

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
	url:'<?php echo url('admin/delete-affliatemanager')?>',
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
