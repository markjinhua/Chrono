@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

 
 
      
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                      <div class="card"  >
                        <div class="card-header">
View All Notification
                        </div>
                        <div class="card-body">
                    <div class="row">
                              
        <div class="col-lg-12">

              <table class="table "  id="example" >
                                            <thead>
                                                <th>Sno</th>
                                                <th>Headline</th>
                                              
                                                <th>Date</th>
                                                <th>Action</th>
                                                
                                            </thead>
                                        <?php 
$news=DB::table('notification as n')->select('*','n.id as nid')->leftjoin('news_and_announcement as a','a.id','=','n.news_id')->where('n.publisher_id',Auth::guard('publisher')->id())->orderBy('n.id','desc')->limit(6)->get();

                                         $sno=0;   ?>

                            @foreach($news as $q)
                            <?php $sno++?>
                            <tr>
                            <td>{{$sno}}</td>
                             <td>{{$q->title}}</td>
                            
                               <td>{{$q->created_at}}</td>
                                <td><a href="{{url('publisher/view-notification')}}/{{$q->nid}}" class="btn btn-primary">View</a> </td>
                           </tr>
                            @endforeach
                                        </table>
   
                            </div>
                        </div>
                    </div>
                </div>
</div>

                @endsection('content')