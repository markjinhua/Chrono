@extends('affliate.affliate_layouts.header')
@extends('affliate.affliate_layouts.sidebar')
@extends('affliate.affliate_layouts.footer')
@section('content')

 
 
      
                        <?php 
                        if($reply!=''){
                        $qry=DB::table('messages')->where('id',$reply)->first();
                    }?>
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                   
                        
        <div class="col-lg-12">
  <div class="card"  >
                                <div class="card-header">
                                    <h3>Create New Message</h3>
                                </div>
                                    <div class="card-body">
                                        <form action="{{url('affliate/send-message')}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                        <div class="row">
<div class="col-lg-12">
  <div class="form-group">
      <label >To</label>
      <select    required=""  class="selectpicker w-100" name="publisher[]" multiple data-actions-box="true">
        
        <?php
          $q=DB::table('publishers')->where('affliate_manager_id',Auth::guard('affliate')->id())->get();
 
    foreach($q as $q){?>
 <option value="{{$q->email}}"  {{$reply!=''?$q->email==$qry->sender?'selected':null:null}} > {{$q->name}} // {{$q->email}}</option>
 
  <?php }
  ?>
      </select>
  </div>
                                      <div class="form-group">
                                    <label >Subject</label>
                                    <input type="text" name="subject" class="form-control" value="{{@$qry->subject}}" required="">
                                      </div>  
                              
                              </div>
                              <div class="col-lg-12">
                                         <div class="form-group">
                                    <label >Message</label>
                 <textarea type="text" id="summernote" name="message" class="form-control" required=""></textarea>
                                      </div>  </div>


                                        <div class="col-lg-12">
                                         <div class="form-group">
                                    <label >Screenshot (Optional)</label>
                                    <input type="file" name="screenshot" class="form-control">
                                      </div>  </div>



                                      <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                        <?php  if($reply!=''){
                            ?>
                  <a class="btn btn-success" href="{{url('admin/messages')}}">Go Back</a>
                  <?php  }?>
                                      </div>
                              
                                    </div>
</form>
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
    @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get("success")}}',
 
 
  confirmButtonText: 'Ok'
})
             @endif
         })
         </script>