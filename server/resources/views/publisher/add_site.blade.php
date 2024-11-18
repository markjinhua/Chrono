@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

 
 
      
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        
                                           
                                <div class="col-lg-12 ">

                            <div class="card"  >
                                <div class="card-header">
                                    <h3> Do this before ading your domain </h3>
                                </div>
                                    <div class="card-body">
                                    	<h6>
                                    	    Please copy Nameserver and update it to your domain. Here is a guide how to update domain name server <a href="https://www.namecheap.com/support/knowledgebase/article.aspx/767/10/how-to-change-dns-for-a-domain/" target="_blank">"Read Here"</a>
                                    	</h6>
                                    		<div class="col-lg-5 m-auto">
                                    			<ul style="list-style:none;">
                                    			    <li>
                                    			        <code>ns1.coder-bd.com</code>
                                    			    </li>
                                    			    <li>
                                    			        <code>ns2.coder-bd.com</code>
                                    			    </li>
                                    			</ul>
                                    		</div>
                                    		Note: It usually takes more than 30 miniutes to point the domain properly
                                    </div>
                                </div>
                            </div>
                            
                            
                        
                        
                        <div class="col-lg-12 ">

                            <div class="card"  >
                                <div class="card-header">
<h3>Add Parking Domain </h3>
                                </div>
                                    <div class="card-body">
                                    	<form action="{{url('publisher/insert-site')}}" method="post">
                                    		@csrf
                                            @if ($errors->any())
  <div class="alert alert-danger">
     <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
     
  </div>
@endif     
                                     
                                    		<div class="col-lg-5 m-auto">
                                    			<div class="form-group">
                                    				<label>Enter Domain Name </label><br/>
                                    				<code>https://example.com</code>

                                    				<input type="url"  placeholder="Enter Url" name="url" class="form-control" required="">
                     
                                    			</div>
                                    		</div>
                                    		<div class="col-lg-5 m-auto">
                                    	 
                                    					<div class="col-lg-12 text-center">
                                    						<button class="btn btn-primary">Save</button>
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
  $(function(){

    @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get("success")}}',
 
 
  confirmButtonText: 'Ok'
})
             @endif
         })
         </script>