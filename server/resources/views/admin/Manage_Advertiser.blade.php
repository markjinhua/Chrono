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
                                <h4>Manage Advertisers</h4>
  </div>
  <div class="card-body">

    
    		<div class="row">
    		
    <div class="col-lg-12 text-right  mt-2 mb-4">
            <button class="btn btn-primary"  data-toggle="modal" data-target="#addModal">Create New Advertiser</button>
        </div>
    	
    		<div class="col-lg-12  table-responsive">
    	<table id="datatable" class="table table">
	<thead>
		<tr>
			<td>Id</td>
			<td>Advertise Name</td>
			<td>Company Name</td>
			<td>Email</td>
			<td>Status</td>
			<td>Hereby</td>
	 
			<td>Action</td>
		</tr>
	</thead>
	<tbody id="showdata">
		
	</tbody>
</table>


<!-- ADD MODAL -->
<form   action="{{url('admin/insert-advertiser')}}" method="post" enctype="multipart/form-data">
      			@csrf
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add  Advertiser Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
     	<div class="row">
     		   <div  class="col-lg-12 form-group">
          <label > Advertiser ID</label>
          <?php $qry=DB::table('advertisers')->orderBy('id','desc')->first();?>
            <input type="text"  class="form-control" value="{{@$qry->id+1}}" disabled>
        </div>
 		 		<div  class="col-lg-6 form-group">
     			<label > Advertiser Name</label>
     				<input type="text" name="advertiser_name" class="form-control" required="">
     		</div>
     		<div  class="col-lg-6 form-group">
     			<label > Company Name</label>
     				<input type="text" name="company_name" class="form-control" required="">
     		</div>
     			<div  class="col-lg-6 form-group">
     			<label > Email</label>
     				<input type="text" name="email" class="form-control" required="">
     		</div>
          <div  class="col-lg-6  form-group">
          <label > Password</label>
            <input type="text" name="password" class="form-control" required="">
        </div>
         <div  class="col-lg-6 form-group">
          <label > Here by</label>
            <input type="text" name="hereby" placeholder="from Google" class="form-control" required="">
        </div>
          <div  class="col-lg-6 form-group">
          <label >Hash/ Clickid  * This is required</label>
            <input type="text" name="param1" placeholder="s2" class="form-control" required="">
        </div>
          <div  class="col-lg-6 form-group">
          <label > Sub Affiliate ID* This is Optional</label>
            <input type="text" placeholder="s1" name="param2" class="form-control" required="">
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
<form action="{{url('admin/update-advertiser')}}" method="post" enctype="multipart/form-data">
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Edit Advertiser</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
      			@csrf
       
 			<div class="row">
     	       <input type="hidden" name="id" id="id">
              <input type="hidden" id="hidden_img" name="hidden_img">
        <div  class="col-lg-6 form-group">
          <label > Advertiser Name</label>
            <input type="text" name="advertiser_name1" class="form-control" required="">
        </div>
        <div  class="col-lg-6 form-group">
          <label > Company Name</label>
            <input type="text" name="company_name1" class="form-control" required="">
        </div>
          <div  class="col-lg-6 form-group">
          <label > Email</label>
            <input type="text" name="email1" class="form-control" required="">
        </div>
        
         <div  class="col-lg-6 form-group">
          <label > Hereby</label>
            <input type="text" name="hereby1" class="form-control" required="">
        </div>

  <div  class="col-lg-6  form-group">
          <label > Photo</label>
            <input type="file" name="photo1" class="form-control" >
        </div>
                <div  class="col-lg-6 form-group">
          <label > Hash</label>
            <input type="text" name="param11" class="form-control" required="">
        </div>
          <div  class="col-lg-6 form-group">
          <label > Click Id</label>
            <input type="text" name="param21" class="form-control" required="">
        </div>

  <div  class="col-lg-6  form-group">
          <label > Previous Image</label>

          <a id="publisher_image_anchor" target="_blank"><img width="70px" height="100px" id="publisher_image"></a>
        </div>
         <div  class="col-lg-6  form-group">
          <label > Status</label>
            <select   name="status1" class="form-control" >
              <option value="Inactive">Inactive</option>
               <option value="Active">Active</option>
                <option value="Ban">Ban</option>
            </select>
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
        <h5 class="modal-title">Delete  Advertiser Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do You want to delete this Advertiser Request.
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
@endsection('content')
<!-- ADD Advertiser Request Modal -->
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
	url:'<?php echo url('admin/show-advertiser')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 		 
 		html+='<tr>'+
					'<td>'+res[i].id+'</td>'+
					'<td>'+res[i].advertiser_name+'</td>'+
						'<td>'+res[i].company_name+'</td>'+
						 
									'<td>'+res[i].email+'</td>'+
                    '<td>'+res[i].status+'</td>'+
										'<td>'+res[i].hereby+'</td>'+
			 
					'<td><div class="dropdown">'+
  '<button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Action'+
  '<span class="caret"></span></button>'+
  '<ul class="dropdown-menu">'+
    '<a href="javascript:;" class="editData py-3" data='+res[i].id+'><li class=py-2>Edit</li> </a>'+
    '<a href="javascript:;" class=" py-3" data='+res[i].id+'><li class=py-2>BAN</li> </a>'+
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
	url:'<?php echo url('admin/edit-advertiser')?>',
	async:false,
	dataType:'json',
	success:function(res){
		 $('#editModal').modal('show');
 
 				$('input[name=id]').val(res.id);
				$('input[name=advertiser_name1]').val(res.advertiser_name);
				$('input[name=company_name1]').val(res.company_name);
				$('input[name=email1]').val(res.email);
	   		 
				$('input[name=hereby1]').val(res.hereby);
                $('input[name=param11]').val(res.param1);
                        $('input[name=param21]').val(res.param2);
			   $('select[name=status1]').val(res.status);
			 $('input[name=hidden_img]').val(res.advertiser_image);
 $('#publisher_image').attr('src','<?php echo asset('uploads/')?>/'+res.advertiser_image+'')
  $('#publisher_image_anchor').attr('href','<?php echo asset('uploads/')?>/'+res.advertiser_image+'')

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
	url:'<?php echo url('admin/delete-advertiser')?>',
	async:false,
	dataType:'json',
	success:function(res){
		 $('#deleteModal').modal('hide');
showdata();
		},


});

})
})


$('#search').click(function(){
	var data=$('#form1').serialize();
	 
$.ajax({
	method:'get',
	data:data,
	url:'<?php echo url('admin/search-Advertiser')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 		 
 		html+='<tr>'+
					'<td>'+res[i].Advertiser_id+'</td>'+
					'<td>'+res[i].created_at+'</td>'+
						'<td>'+res[i].name+'</td>'+
							'<td>'+res[i].method+'</td>'+
								'<td>'+res[i].amount+'</td>'+
									'<td>'+res[i].status+'</td>'+
										'<td>'+res[i].payterm+'</td>'+
					 	'<td>'+res[i].from_date+' '+res[i].to_date+'</td>'+
					'<td><a href="javascript:;" class="editData" data='+res[i].id+'>Details </a>&nbsp;<a  href="javascript:;" class="text-danger deleteData" data='+res[i].id+'>Delete</a></td>'
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

})
});
</script>
