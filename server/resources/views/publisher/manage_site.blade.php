@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')
 	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card radius-10">
                            	<div class="card-header">
                            		<h4>View Parking Domain</h4>
  </div>
  <div class="card-body">
    		<div class="col-lg-12 text-right mb-4 mt-2">
    				<a class="btn btn-primary" href="{{url('publisher/add-site')}}" >Add  Parking Domain</a>
    		</div>
    		<div class="col-lg-12">
    	<table id="datatable" class="table table-striped table-bordered w-100">
	<thead>
		<tr>
			<td>ID</td>
		 
			<td>Url</td>
	 
			<td>Action</td>
		</tr>
	</thead>
	<tbody id="showdata">
		
	</tbody>
</table>


<!-- ADD MODAL -->

<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add   Site</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="form1">
      			@csrf
     	<label > Site Address</label>

     <input type="text" name="Site_address" class="form-control" >
 </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSave">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End ADD MODAL -->



<!-- Edit MODAL -->

<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit   Site</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="form2">
      			@csrf
      
<input type="hidden" name="id" id="id">
    
                                    			<div class="form-group">
                                    				<label>Name</label>
                                    				<input type="" placeholder="Enter Name" name="name" class="form-control" required="">
                                    			</div>
                                    	  
                                    			<div class="form-group">
                                    				<label>Url</label>
                                    				<input type="url"  placeholder="Enter Url" name="url" class="form-control" required="">
                                    			</div>
                                      
                                    			<div class="form-group">
                                    				<label>Description</label>
                                    				<textarea type="" placeholder="Enter Description" name="description" class="form-control" required=""></textarea>
                                    			</div>
 </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Edit MODAL -->

<!-- Delete MODAL -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Site</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do You want to delete this  Site.
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
<!-- ADD BAN Site Modal -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(function(){
showdata();
function showdata(){
$.ajax({
	method:'get',
	url:'<?php echo url('publisher/show-site')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 			var button='';
 			if(res[i].publisher_id!=null){
 				button='<a  href="javascript:;" class="text-danger deleteData" data='+res[i].id+'>Delete</a>';
 			}
      else{
        button='';
      }
 		html+='<tr>'+
					'<td>'+sno+'</td>'+
				 
					'<td><a href='+res[i].url+' target="_blank">'+res[i].url+'</a></td>'+
 
					'<td>'+button+'</td>'
 				+'</tr>';
 		}	 
 	$('#datatable').DataTable().destroy();
 		$('#showdata').html(html);
 			$('#datatable').DataTable().draw();

 	
	},
	error:function(){
			alert('Error')
	}

})
	
}



//EDIT DATA
$('#showdata').on('click','.editData',function(){
$('#editModal').modal('show');
let id=$(this).attr('data');
$.ajax({
	method:'get',
	data:{id:id},
	url:'<?php echo url('publisher/edit-site')?>',
	async:false,
	dataType:'json',
	success:function(res){
			$('input[name=name]').val(res.name);
			$('input[name=url]').val(res.url);
			$('textarea[name=description]').val(res.description);
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
	url:'<?php echo url('publisher/delete-site')?>',
	async:false,
	dataType:'json',
	success:function(res){
		 $('#deleteModal').modal('hide');
showdata();
		},


});

})
})

// Update DATA

$('#btnUpdate').unbind().click(function(){
	let data=$('#form2').serialize();
 
	$.ajax({
	method:'post',
	data:data,
	url:'<?php echo url('publisher/update-site')?>',
	async:false,
	dataType:'json',
	success:function(res){
 $('#form2')[0].reset();
 $('#editModal').modal('hide');
showdata();


	},
	error:function(){
			alert('Error')
	}


})

})

//ADD DATA

$('#btnSave').unbind().click(function(){
	let data=$('#form1').serialize();
	let result='';
	if($('input[name=Site_address]').val()==''){
		$('input[name=Site_address]').addClass('is-invalid');
	}
	else{
		$('input[name=Site_address]').removeClass('is-invalid');
	result+='1';
	}
	if(result=='1'){
	$.ajax({
	method:'post',
	data:data,
	url:'<?php echo url('admin/insert-ban-Site')?>',
	async:false,
	dataType:'json',
	success:function(res){
 $('#form1')[0].reset();
 $('#addModal').modal('hide');
 showdata();
	},
	error:function(){
			alert('Error')
	}


})
}
})
});
</script>
