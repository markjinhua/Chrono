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

            <h4>Mail Room </h4>
         
                              </div>
                              <div class="card-body">
    	<form action="{{url('affliate/send-mail')}}" method="post">
    		@csrf
    		<input type="hidden" name="id" value="{{Auth::guard('affliate')->id()}}" >
    	<div class="row mt-4">
    	 
    		<div class="col-lg-12">
    			<label class="form-label">Email Address</label>
    			<input  class="form-control" type="email" name="email" required="">
    			 
    		</div>
    				<div class="col-lg-12">
    			<label class="form-label">Subject</label>
    			 
    			<input class="form-control" type="" name="subject" required="">
    		</div>

                    <div class="col-lg-12">
                <label class="form-label">Email Body</label>
                 
                <textarea id="summernote" rows=9 class="form-control" type="" name="message" required=""></textarea> 
            </div>
    			<div class="col-lg-4">
    			<button class="btn btn-success " style="margin-top: 33px">Send</button>
    			 
    			 
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
  $(function(){
    $('#summernote').summernote({height:200});
  @if(Session::has('success'))   Swal.fire({

  title: '{{Session::get("success")}}',
 
 
  confirmButtonText: 'Ok'
})
	    
            
             @endif

})</script>