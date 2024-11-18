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
                            		<h4>Manage Cashout</h4>
  </div>
  <div class="card-body">
  	<div class="row">
    		<div class="col-lg-12 text-right  mt-2">
    				<button class="btn btn-primary"  data-toggle="modal" data-target="#addModal">Create Withdrawl Request</button>
    		</div>
    	</div>
    
     
    	 
    		<div class="row">
    		

    	
    		<div class="col-lg-12 table-responsive">
    	<table id="datatable" class="table table">
	<thead>
		<tr>
			<td>Id</td>
			<td>Date</td>
			<td>Affliate</td>
			<td>Method</td>
			<td>Amount</td>
			<td>Status</td>
			<td>Payterm</td>
			<td>Pay Period</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody id="showdata">
		
	</tbody>
</table>
</div>
<div class="col-lg-12">
  <h4>Automate Withdrawl Request</h4>
 



  <a  href="{{url('admin/InstantWithdraw')}}"  class="btn btn-primary">Instant Widthraw</a>
 
      
  </div>

<!-- ADD MODAL -->
<form   action="{{url('admin/insert-cashout-affliate')}}" method="post">
      			@csrf
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add  Cashout Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
     	<div class="row">
           <div class="col-lg-3 ">
            <label>Balance</label>
      <input type="text" class="form-control" name="balance" readonly="true">     
      </div>
     		<div class="col-lg-12 form-group">
     			<label >Select Affliate</label>
 		 	<select type="text" name="affliate_id" class="form-control" id="publisher_id"  required="">
			<option value="">Select Affliate</option>
			<?php 
		$qry=DB::table('affliates')->get();
		foreach($qry as $q){?>
 <option value="{{$q->id}}"  data="{{$q->balance}}" >{{$q->name}}</option>
 
  <?php }
  ?>
		</select>
 		 	</div>
      <div class="col-lg-12 form-group">
          <label >Select Payment Terms</label>
      <select type="text" name="payment_terms" class="form-control"  >
 
             
                <option value="On Requested">On Requested</option>

      </select>

</div>



 		 		<div  class="col-lg-4 form-group">
     			<label > From Date</label>
     				<input type="date" name="from_date" class="form-control" required="">
     		</div>
     		<div  class="col-lg-4 form-group">
     			<label > To Date</label>
     				<input type="date" name="to_date" class="form-control" required="">
     		</div>
     			<div  class="col-lg-12 form-group">
     			<label > Amount</label>
     				<input type="number" name="amount" id="amount" class="form-control" required="">
     		</div>

 		 	<div class="col-lg-12 form-group">
     			<label >Note</label>
 		 		<textarea   name="note" class="form-control"  ></textarea> 
 		 	</div>
 </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="save">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 </form>
<!-- End ADD MODAL -->



<!-- Edit MODAL -->
<form action="{{url('admin/update-cashout-affliate')}}" method="post">
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Withdraw Request No <span id="withdraw_id"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
      			@csrf
      
<input type="hidden" name="id" id="id">
<input type="hidden" name="old_amount" >
<input type="hidden" name="affliate_id" >
    	<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Affliate</p>
     		 </div>
     		  <div class="col-lg-8"><p id="affliate"></p></div>
 			</div>
 		<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Method</p>
     		 </div>
     		  <div class="col-lg-8"><p id="methoddiv"></p></div>
 			</div>
      <div class="row">
         <div class="col-lg-3">
          <p>Details</p>
         </div>
          <div class="col-lg-8"><p id="detail"></p></div>
      </div>
 			<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Note</p>
     		 </div>
     		  <div class="col-lg-8"><p id="notediv"></p></div>
 			</div>
 			<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Payment Term</p>
     		 </div>
     		  <div class="col-lg-8"><p id="paymentdiv"></p></div>
 			</div>
 			<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Period</p>
     		 </div>
     		  <div class="col-lg-8"><p id="perioddiv"></p></div>
 			</div>
 			<div class="row mb-2">
     		 <div class="col-lg-3 ">
     		 	<p>Amount</p>
     		 </div>
     		  <div class="col-lg-4"><input name="amount1" class="form-control" ></div>
 			</div>
 			<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Status</p>
     		 </div>
     		  <div class="col-lg-3">
     		  	<select id="status"  class="form-control mb-3" name="status">
     
     		  		<option value="Pending">Pending</option>
     		  		<option value="Locked">Locked</option>
     		  		<option value="Completed">Completed</option>
     		  		<option value="Cancelled">Cancelled</option>
     	<!-- 	  		<option value="Rejected">Rejected</option> -->
     		  </select></div>
 			</div>
 			<div class="row">
     		 <div class="col-lg-3">
     		 	<p>Date Of Cashout Request</p>
     		 </div>
     		  <div class="col-lg-8"><p id="datediv"></p></div>
 			</div>
 			<div class="row">
     	 
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
        <h5 class="modal-title">Delete  Cashout Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do You want to delete this Cashout Request.
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
<!-- ADD Cashout Request Modal -->
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
let balance=0;
$('#publisher_id').change(function(){
 
   balance = $('option:selected', this).attr('data');
$('input[name=balance]').val(parseFloat(balance).toFixed(2));
})
 


showdata();
function showdata(){
$.ajax({
	method:'get',
	url:'<?php echo url('admin/show-cashout-affliate')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 		 
 		html+='<tr>'+
					'<td>'+res[i].cashout_id+'</td>'+
					'<td>'+res[i].created_at+'</td>'+
						'<td>'+res[i].name+'</td>'+
							'<td>'+res[i].method+'</td>'+
								'<td>'+parseFloat(res[i].amount).toFixed(2)+'</td>'+
									'<td>'+res[i].status+'</td>'+
										'<td>'+res[i].payterm+'</td>'+
					 	'<td>'+res[i].from_date+' '+res[i].to_date+'</td>'+
					'<td><a href="javascript:;" class="editData" data='+res[i].id+'>Details </a>&nbsp;</td>'

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
	url:'<?php echo url('admin/edit-cashout-affliate')?>',
	async:false,
	dataType:'json',
	success:function(res){
		 $('#editModal').modal('show');
 
				$('select[name=status]').val(res.status);

				$('#affliate').html(res.name);
				$('#methoddiv').html(res.method);
				$('#notediv').html(res.note);
     
            $('#detail').html(res.payment_details);
				$('#paymentdiv').html(res.payterm);
				$('#perioddiv').html(res.from_date+' to '+ res.to_date);
				$('input[name=amount1]').val(parseFloat(res.amount).toFixed(2));
        $('input[name=old_amount]').val(parseFloat(res.amount).toFixed(2));
  
         $('input[name=affliate_id]').val(res.affliate_id);
			 
				$('#datediv').html(res.created_at);
			 

$('#withdraw_id').html(res.id);
			$('#id').val(res.id);

		},



})
})

// //EDIT DATA
// $('#showdata').on('click','.deleteData',function(){
// $('#deleteModal').modal('show');
// let id=$(this).attr('data');
// $('#btnDelete').unbind().click(function(){
// $.ajax({
// 	method:'get',
// 	data:{id:id},
// 	url:'<?php echo url('admin/delete-cashout')?>',
// 	async:false,
// 	dataType:'json',
// 	success:function(res){
// 		 $('#deleteModal').modal('hide');
// showdata();
// 		},


// });

// })
// })


$('#search').click(function(){
	var data=$('#form1').serialize();
	 
$.ajax({
	method:'get',
	data:data,
	url:'<?php echo url('admin/search-cashout')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 		 
 		html+='<tr>'+
					'<td>'+res[i].cashout_id+'</td>'+
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
