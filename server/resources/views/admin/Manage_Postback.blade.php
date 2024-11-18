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
                            		<h4>Manage Postback</h4>
  </div>
  <div class="card-body">
    			<form id="form1">
    		<div class="row">

    	  
    	 
    			<div class="col-lg-2">
    				<label class="form-label">Network Name</label>
    				<input type="" name="network_name" class="form-control"   id="network_name">
    			</div>
    		  
 <div class="col-lg-2">
		<label class="form-label">By</label>
		<select type="text" name="status" id="status"  class="form-control">
			<option value="">Click Id</option>
			<option value="Inactive"   >Advertiser Id</option>
			<option value="Active"   >Affiliate Id</option>
		</select>
	</div>
</div> 
<div class="row">

 <div class="col-lg-2">
		<label class="form-label">From</label>
	<input type="date" name="from_date" class="form-control"   id="from_date">
	</div>

 <div class="col-lg-2">
		<label class="form-label">To</label>
	<input type="date" name="to_date" class="form-control"   id="to_date">
	</div>

		<div class="col-lg-2 " style="margin-top: 33px">
		
		<button type="button" class="btn btn-primary" id="search">Search</button>
	</div>
	</div>
	 	
 
 </form>
 <div class="row">
    			<div class="col-lg-12 mt-3  table-responsive">

    				<table id="datatable" class="table table-sm ">
    					<thead>
    					<tr>
    						<td>ID</td>
    						<td>DATE</td>
    						<td>NETWORK NAME</td>
    						<td>UID</td>
    						<td>ADV.ID</td>
    						<td>CLICK ID</td>

    						<td>STATUS</td>

    						<td>REVENUE</td>
    						<td>IP</td>
    						
    					</tr>
    				</thead>
    				<tbody id="showdata" class="text-dark">
    					
    				</tbody>
    				</table>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</div>
</div>
</div>


@endsection('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

 	  
<script type="text/javascript">
	 $('.js-example-basic-multiple').select2();
	 
	$(function(){
		$('#datatable').DataTable({'ordering':false,'lengthChange':false,'destroy':true,})
showdata();
function showdata(){
$.ajax({
	method:'get',
	url:'<?php echo url('admin/show-Postback')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 			 let clicks=res[i].clicks==null?0:res[i].clicks;
 			  let conversion=res[i].conversion==null?0:res[i].conversion;
 			   let smartlink=res[i].smartlink==null || res[i].smartlink==0?'No':'Yes';
 			   let incentive_allowed=res[i].incentive_allowed==null || res[i].incentive_allowed==0?'No':'Yes';
 			   let magiclink=res[i].magiclink==null || res[i].magiclink==0?'No':'Yes';
 			   let native=res[i].native==null || res[i].native==0?'No':'Yes';
 			   let lockers=res[i].lockers==null || res[i].lockers==0?'No':'Yes';
 			 
 		html+='<tr>'+
					'<td>'+res[i].Postbackid+'</td>'+
					'<td>'+res[i].Postback_name+'</td>'+
					'<td>'+res[i].category_name+'</td>'+
					'<td>'+res[i].countries+'</td>'+
					'<td>'+res[i].payout_type+'</td>'+
					'<td>'+res[i].payout+'</td>'+
					'<td>'+res[i].ua_target+'</td>'+
					'<td>'+res[i].status+'</td>'+
						'<td style="text-transform:uppercase">'+res[i].Postback_type+'</td>'+
					'<td>'+clicks +'</td>'+
					'<td>'+conversion +'</td>'+
					'<td>'+incentive_allowed+'</td>'+
					'<td>'+smartlink+'</td>'+
					'<td>'+magiclink+'</td>'+
					'<td>'+native+'</td>'+
					'<td>'+lockers+'</td>'+
					'<td>'+res[i].publisher_name+'</td>'+

					'<td><a href="{{url('admin/edit-Postback')}}/'+res[i].Postbackid+'" class="editData" data='+res[i].id+'>Edit </a>&nbsp;<a  href="javascript:;" class="text-danger deleteData" data='+res[i].id+'>Delete</a></td>'
 				+'</tr>';
 		}	 
 	$('#datatable').DataTable().destroy();
 		$('#showdata').html(html);
 			$('#datatable').DataTable({ordering:false}).draw();

 	
	},
	error:function(){
		 
	}

})
	
}

$('#search').click(function(){
	var data=$('#form1').serialize();
	console.log(data);
$.ajax({
	method:'get',
	data:data,
	url:'<?php echo url('admin/search-Postback')?>',
	async:false,
	dataType:'json',
	success:function(res){
			
 		let html='';
 		let sno=0;
 		for(var i=0;i<res.length;i++){
 			sno++;
 			 let clicks=res[i].clicks==null?0:res[i].clicks;
 			  let conversion=res[i].conversion==null?0:res[i].conversion;
 			   let smartlink=res[i].smartlink==null || res[i].smartlink==0?'No':'Yes';
 			   let incentive_allowed=res[i].incentive_allowed==null || res[i].incentive_allowed==0?'No':'Yes';
 			   let magiclink=res[i].magiclink==null || res[i].magiclink==0?'No':'Yes';
 			   let native=res[i].native==null || res[i].native==0?'No':'Yes';
 			   let lockers=res[i].lockers==null || res[i].lockers==0?'No':'Yes';
 			 
 		html+='<tr>'+
					'<td>'+res[i].Postbackid+'</td>'+
					'<td>'+res[i].Postback_name+'</td>'+
					'<td>'+res[i].category_name+'</td>'+
					'<td>'+res[i].countries+'</td>'+
					'<td>'+res[i].payout_type+'</td>'+
					'<td>'+res[i].payout+'</td>'+
					'<td>'+res[i].ua_target+'</td>'+
					'<td>'+res[i].status+'</td>'+
						'<td  style="text-transform:uppercase">'+res[i].Postback_type+'</td>'+
					'<td>'+clicks +'</td>'+
					'<td>'+conversion +'</td>'+
					'<td>'+incentive_allowed+'</td>'+
					'<td>'+smartlink+'</td>'+
					'<td>'+magiclink+'</td>'+
					'<td>'+native+'</td>'+
					'<td>'+lockers+'</td>'+
					'<td>'+res[i].publisher_name+'</td>'+

					'<td><a href="{{url('admin/edit-Postback')}}/'+res[i].Postbackid+'" class="editData" data='+res[i].id+'>Edit </a>&nbsp;<a  href="javascript:;" class="text-danger deleteData" data='+res[i].id+'>Delete</a></td>'
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
})
</script>