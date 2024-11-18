   @extends('affliate.affliate_layouts.header')
@extends('affliate.affliate_layouts.sidebar')
@extends('affliate.affliate_layouts.footer')
@section('content')

 
 
      
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                   
                        
        <div class="col-lg-12">
  <div class="card"  > 
    <div class="mt-4 col-lg-12 table-responsive">
        <table   width="100%" id="example" class="table table-bordered table-striped">
   <thead>
                                                <th>Message Id</th>
                                                <th>Sender</th>
                                                <th>Subject</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                                
                                            </thead>
<tbody>
       <?php 
 $qry=DB::table('messages as m')->where('m.receiver','affliate')->Orwhere('m.receiver','admin')->where('m.affliate_id',Auth::guard('affliate')->id())->orderBy('m.id','desc')->get();

                                            ?>

                            @foreach($qry as $q)
                            <tr>
                            <td>{{$q->id}}</td>
                             <td>{{$q->sender}}</td>
                              <td>{{$q->subject}}</td>
                               <td>{{$q->created_at}}</td>
                              <td><a href="{{url('affliate/view-message')}}/{{$q->id}}" class="btn btn-primary">View</a> <a href="{{url('affliate/messages')}}/{{$q->id}}" class="btn btn-danger">Reply</a></td>
                           </tr>
                            @endforeach
                                        </table>

           
        </div>
      </div>
    </div>
  </div>
</div>
</div>
     <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

@endsection('content')