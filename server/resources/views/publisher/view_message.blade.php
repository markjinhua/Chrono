@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

 
 
      
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                   
                        
        <div class="col-lg-6">
  <div class="card"  >
    <?php $qry=DB::table('messages')->where('id',$id)->first();?>
                                <div class="card-header">
                                    <h3>View Message</h3>
                                </div>
                                    <div class="card-body">
                                        <b>From Support Team</b>
                                        <p><b>Subject</b> : {{$qry->subject}}</p>
                                        <p><b>Message </b>: {!!$qry->message!!}</p>
                                            @if($qry->screenshot!='')
                                     <a href="{{url('screenshot')}}/{{$qry->screenshot}}" target="_blank"><img src="{{asset('screenshot')}}/{{$qry->screenshot}}" class="image-responsive" width="100" height="100"> </a>
                                     @endif
                                    <p> <a href="{{url('publisher/support')}}/{{$qry->id}}" class="btn btn-danger">Reply</a>
                                        <button class="btn btn-success" onclick=" window.history.back();">Go Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection('content')