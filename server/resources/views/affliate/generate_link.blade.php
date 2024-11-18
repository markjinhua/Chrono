@extends('affliate.affliate_layouts.header')
@extends('affliate.affliate_layouts.sidebar')
@extends('affliate.affliate_layouts.footer')
@section('content')

   

      
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                    	<div class="col-lg-12">
                    		<div class="card">
                    			<div class="card-header">
                    					<h4>Generate Link</h4>
                    			</div>
                    			<div class="card-body">
                                    <div class="alert alert-primary">
                                            <h5>Share this link whom you want to join under your team.</h5>
                                    </div>
                                        <div class="col-lg-6 m-auto text-center">
                                        <div class="alert alert-success">
                    				<h5>{{url('publisher/register')}}?&id={{Auth::guard('affliate')->id()}}</h5>
                                </div>
                                </div>
                            
                    			</div>
                    		</div>
                    	</div>
                    </div>


                </div>
            </div>


            @endsection('content')