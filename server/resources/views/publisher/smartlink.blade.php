@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card radius-10">
                            	<div class="card-header">
									<h5 class="mb-0">Smartlink</h5>
								</div>
                                <div class="card-body">
                                    <form action="{{url('publisher/insert-smartlink')}}"  method="post">
                                        @csrf
<div class="row">
    <div class="col-lg-12">
              @if($errors->any())

<div class="alert alert-danger">
    {!! implode('', $errors->all('<div>:message</div>')) !!}

</div>
@endif
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-3">

        <input type="text"  placeholder="Enter Name" name="name" class="form-control">
    </div>
     <div class="col-lg-3">

        <input type="text" placeholder="Enter Traffic Source" name="traffic_source" class="form-control">
    </div>
<div class="col-lg-3">
         <select class="form-control" id="domain" name="domain">
                 <?php
                 $domain=DB::table('site_settings')->first();
$qry1=DB::table('smartlink_domain')->get();
                 ?>
                 <option value="">Select Domain</option>
                @foreach($qry1 as $q)
                <option value="{{$q->url}}" {{$domain->default_smartlink_domain==$q->url?'selected':''}}>{{$q->url}}</option>
                @endforeach
             </select>
</div>

<div class="col-lg-3">
         <select class="form-control" id="category"  name="category">
                 <?php
$qry=DB::table('category')->get();
                 ?>
                 <option value="">Select Category</option>
                @foreach($qry as $q)
                <option value="{{$q->id}}">{{$q->category_name}}</option>
                @endforeach
             </select>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class=" mb-5">




          </div>

<div class="mt-3" style="display: none">
              <h4><b>Smart Link</b></h4>
              <?php  $random=substr(number_format(time() * rand(),0,'',''),0,6);

?>

    <div class="alert alert-success" role="alert" style="height: auto;width:100%;">
        <span id="offer_name"><span id="url">{{@$qry1[0]->url}}</span>/links?&pubid={{Auth::guard('publisher')->id()}}&key={{$random}}<span id="sid"></span><span id="sid2"></span><span id="sid3"></span><span id="sid4"></span><span id="sid5"></span></span>
    </div>
    <input type="hidden" name="url" class="form-control">
     <input type="hidden" name="key" value="{{$random}}" class="form-control">
</div>

<button type=button class="btn btn-primary mt-3" id="save">Save Smartlink</button>
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
            <script>

                $(function(){
                      @if(Session::has('success'))
             Swal.fire({
  title: '{{Session::get("success")}}',


  confirmButtonText: 'Ok'
})
             @endif

    $('#domain').change(function(){

            $('#url').html($('#domain').val());


    })
    $('#save').click(function(){
         $('input[name=url]').val($('#offer_name').text());
         $('form').submit();
    })

})
</script>
<script type="text/javascript">

function sid1() {
  var x = document.getElementById("myInput").value;
  document.getElementById("sid").innerHTML = "&sid=" + x;
}
function sid2() {
  var x2 = document.getElementById("myInput2").value;
  document.getElementById("sid2").innerHTML = "&sid2=" + x2;
}
  function sid3() {
  var x3 = document.getElementById("myInput3").value;
  document.getElementById("sid3").innerHTML = "&sid3=" + x3;
}
  function sid4() {
  var x4 = document.getElementById("myInput4").value;
  document.getElementById("sid4").innerHTML = "&sid4=" + x4;
}
  function sid5() {
  var x5 = document.getElementById("myInput5").value;
  document.getElementById("sid5").innerHTML = "&sid5=" + x5 ;


}
</script>
