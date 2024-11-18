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
        <tr>
            <td>Id</td>
            <td>Date </td>
       <td>Email</td> 
       <td>Subject</td> 
            <td>Body</td>

</tr>
</thead>
<tbody>
    <?php 
    $qry=DB::table('mail_room')->where('affliate_id',Auth::guard('affliate')->id())->get();?>
    @foreach($qry as $q)
        <tr>
            <td>{{$q->id}}</td>
            <td>{{$q->created_at}}</td>
            <td>{{$q->email}}</td>
            <td>{{$q->subject}}</td>
            <td>{!!$q->message!!}</td>
            

        </tr>
    @endforeach
</tbody>
</table>

           
        </div>
      </div>
    </div>
  </div>
</div>
</div>
     <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

@endsection('content')