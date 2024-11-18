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

            <h4>View Offer Details </h4>
         
                              </div>
                              <div class="card-body">
    	<form action="{{ route('affliate.offer') }}" method="get">
    	<div class="row">
    	    <div class="col-lg-12">
    	        @if(Session::has('danger'))
        	        <div class="alert alert-danger">
        	            {{ Session::get("danger") }}
        	        </div>
    	        @endif
    	    </div>
    		<div class="col-lg-8">
    			<label class="form-label">Offer ID</label>
    			<input  class="form-control" type="text" name="offer_id">
    			 
    		</div>
    			<div class="col-lg-4">
    			<button class="btn btn-dark " style="margin-top: 30px">Search</button>
    			 
    			 
    		</div>
    </div>
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
<script type="text/javascript">
	    @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get("success")}}',
 
 
  confirmButtonText: 'Ok'
})
             @endif
</script>