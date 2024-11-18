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
    <?php $qry=DB::table('notification as n')->leftJoin('news_and_announcement as a','a.id','=','n.news_id')->where('n.id',$id)->first();?>
                                <div class="card-header">
                                    <h3>View Notification</h3>
                                </div>
                                    <div class="card-body">
                                        <p><b>Title</b>: {{$qry->title}}</p>    
                                        <p><b>Details</b>: {!!$qry->description!!}</p>
                                            
                                        <button class="btn btn-success" onclick=" window.history.back();">Go Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection('content')