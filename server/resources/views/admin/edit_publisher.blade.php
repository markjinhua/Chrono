@extends('admin.admin_layouts.header')
@extends('admin.admin_layouts.sidebar')
@extends('admin.admin_layouts.footer')
@section('content')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card radius-10">
                              <div class="card-header">
                                <h4>Edit Publisher</h4>
  </div>
  <div class="card-body">

    		<?php $qry=DB::select("SELECT *,(select count(id) from offer_process as o where o.unique_=1 and o.publisher_id=p.id) as unique_clicks,(select count(id) from offer_process where    publisher_id=p.id) as total_clicks,(select count(id) from offer_process where status='Approved' and    publisher_id=p.id) as total_leads,(select sum(payout) from offer_process where    publisher_id=p.id and status='Approved') as tot_earnings ,(select sum(amount) from cashout_request where    affliate_id=p.id and status!='Cancelled') as total_withdrawn,(select count(amount) from cashout_request where    affliate_id=p.id and status='Locked') as locked_withdrawl,(select count(amount) from cashout_request where    affliate_id=p.id and status='Cancelled') as cancelled_withdrawl,(select count(id) from cashout_request where    affliate_id=p.id and status!='Cancelled') as no_of_withdrawl FROM publishers as p where p.id='$id' order by p.id desc");?>

<!-- Edit MODAL -->
<form action="{{url('admin/update-publishers')}}" method="post" enctype="multipart/form-data">

            @csrf
       <input type="hidden" id="id" name="id" value="{{$qry[0]->id}}">
        <input type="hidden" name="hidden_img" value="{{$qry[0]->publisher_image}}">
                <input type="hidden" name="hidden_nid" value="{{$qry[0]->nid}}">
                        <input type="hidden" name="hidden_tax" value="{{$qry[0]->tax_file}}">
      <div class="row">
                 <div class="form-group col-lg-6">
                                  <label><b> Name</b></label>
                                  <input type="text" value="{{$qry[0]->name}}" name="name" class="form-control">
                                </div>

                               <div class="col-lg-6   " >
                                           <label><b>Phone</b></label>
                                        <div class="form-group"  >

                                        <select class="form-control" name="phone_code"   style="width: 30%;float: left;" >


                <?php
        $q=DB::table('countries')->get();

        foreach($q as $q){
            ?>
            <option value="{{$q->phonecode}}" {{$q->phonecode==$qry[0]->phone_code?'selected':null}}>{{$q->phonecode}}-{{$q->country_name}}</option>
        <?php }?>



</select>
               <input type="number" placeholder="Enter Phone Number " style="width: 70%;float: left" class="form-control" value="{{$qry[0]->phone}}" name="phone">

                                    </div>
                                  </div>


                              <div class="form-group col-lg-6">
                                <label><b>Address</b></label>
                                <input type="text" value="{{$qry[0]->address}}" name="address" class="form-control">
                              </div>
                              <div class="form-group col-lg-6">
                                <label><b>Region</b></label>
                                <input type="text" value="{{$qry[0]->region}}" name="region" class="form-control">
                              </div>

                                <div class="form-group col-lg-6">
                                <label><b>City</b></label>
                                <input type="text" value="{{$qry[0]->city}}" name="city" class="form-control">
                              </div>
                                  <div class="col-lg-6  col-lg-6" >
                                        <div class="form-group"  >
                                            <label><b>Zip/Postal Code</b></label>
                                           <input type="text" placeholder="Enter Zip/Postal Code" class="form-control " value="{{$qry[0]->postal_code}}" name="zip">

                                    </div>
                                  </div>
                                   <div class="col-lg-6" >
                                        <div class="form-group"  >
                                            <label><b>Skype</b></label>
                                           <input type="text" placeholder="Enter Skype Name " class="form-control @error('skype') is-invalid @enderror"  value="{{$qry[0]->skype}}" name="skype">

                                    </div>
                                  </div>

        <div  class="col-lg-6  form-group">
          <label > Account Status</label>
            <select type="text" name="status"  id="status"  class="form-control" >

      <option value="Inactive" {{$qry[0]->status=='Inactive'?'selected':''}} >Inactive</option>
      <option value="Active"     {{$qry[0]->status=='Active'?'selected':''}} >Active</option>
    </select>
        </div>
         <div  class="col-lg-6  form-group">
          <label > Affliate Manager</label>
             <select type="text" name="affliate_manager" class="form-control" >
      <option value="">Select Affliate Manager</option>
      <?php
    $q=DB::table('affliates')->get();
    foreach($q as $q){?>
 <option value="{{$q->id}}" {{$qry[0]->affliate_manager_id==$q->id?'selected':''}} >{{$q->name}}</option>

  <?php }
  ?>
    </select>
        </div>

        <div  class="col-lg-6 form-group">
          <label > Email</label>
            <input type="email" name="email" value="{{$qry[0]->email}}" class="form-control" required="">
        </div>

           <div  class="col-lg-6 form-group">
                  <label class="form-label">Countries</label>

  <select class="form-control" name="countries" style="width: 100%" >
 <option></option>
 <?php
 $country=DB::table('countries')->get();
foreach($country as $q){
      ?>
        <option value="{{$q->country_name}}" {{$qry[0]->country==$q->country_name?'selected':''}}>{{$q->country_name}}</option>
    <?php }
?>
</select>
</div>

                                    <div class="col-lg-6  " >
                                        <div class="form-group"  >
                                            <label><b>Website Url</b></label>
                                           <input type="text" placeholder="Enter Website Url " class="form-control "  value="{{$qry[0]->website_url}}" name="website_url">

                                    </div>
                                  </div>


      <div class="col-lg-6  " >
                                        <div class="form-group"  >
                                            <label><b>Monthly Traffic</b></label>

                                              <select  class="form-control @error('monthly_traffic') is-invalid @enderror"  value="{{$qry[0]->monthly_traffic}}" name="monthly_traffic"  >
            <option value="" >Select  Traffic</option>
            <option value="Less than 1k" {{'Less than 1k'==$qry[0]->monthly_traffic?'selected':null}}>Less than 1k</option>
            <option value="1K to 5K" {{'1K to 5K'==$qry[0]->monthly_traffic?'selected':null}}>1K to 5K</option>
              <option value="5K to 10K" {{'5K to 10K'==$qry[0]->monthly_traffic?'selected':null}}>5K to 10K</option>
              <option value="10K to 50K" {{'10K to 50K'==$qry[0]->monthly_traffic?'selected':null}}>10K to 50K</option>
              <option value="50K  to 100K" {{'50K  to 100K '==$qry[0]->monthly_traffic?'selected':null}}>50K  to 100K</option>
              <option value="100K to 1M" {{'100K to 1M'==$qry[0]->monthly_traffic?'selected':null}}>100K to 1M</option>
              <option value="More than 1 M" {{'More than 1 M'==$qry[0]->monthly_traffic?'selected':null}}>More than 1 M</option>



                                   </select>
                                    </div>
                                  </div>

  <div class="col-lg-6  " >
                                        <div class="form-group"  >
                                                <label><b>Site Category</b></label>
                                  <select  name="category" class="form-control @error('category') is-invalid @enderror"   value="{{$qry[0]->category}}">
            <option value="">Select  Category</option>
               <option value="Adult" {{'Adult'==$qry[0]->category?'selected':null}}>Adult</option>
                  <option value="Not Adult" {{'Not Adult'==$qry[0]->category?'selected':null}}>Not Adult</option>
            <?php
        $q=DB::table('category')->where('is_deleted','0')->get();
        foreach($q as $q){?>
    <option value="{{$q->category_name}}" {{$q->category_name==$qry[0]->category?'selected':null}}>{{$q->category_name}}</option>

  <?php }
  ?>        </select>
</div>
</div>
       <div class="col-lg-12 " >
         PLZ CLICK ON THIS LINK AND COMPLETE YOUR INFORMATION THEN DOWNLOAD THE PDF FILE AND UPLOAD IT HERE
                                        <div class="form-group"  >
                                            <label><b>Tax</b></label>
                                           <input type="file" placeholder="Enter Website Url " class="form-control "  name="tax_file">
                                         </div>
                                            <div class="form-group"  >
                                             <label ><b>Additional Information</b></label>
                                           <textarea name="tax_note" value="{{$qry[0]->additional_information}}" class="form-control">{{$qry[0]->additional_information}}</textarea>
                                           @if($qry[0]->tax_file!='')
                                           <a type="button" class="btn btn-info mt-2" download href="{{url('uploads/')}}/{{$qry[0]->tax_file}}">Download Submitted File </a>
                                           @endif

                                    </div>
                                  </div>
       <div class="col-lg-12  " >
                                        <div class="form-group"  >
                                            <label><b>NID/PASSPORT</b></label>
                                           <input type="file" placeholder="Enter Website Url " class="form-control "  name="nid">
                                           @if($qry[0]->nid!='')
                                           <a href="{{url('uploads/')}}/{{$qry[0]->nid}}" type="button" class="btn btn-success mt-2" download >Download Nid/Passport</a>
                                           @endif

                                    </div>
                                  </div>

                <div  class="col-lg-10  form-group">
          <label > Photo</label>
            <input type="file" name="photo1" class="form-control" >
        </div>
  <div  class="col-lg-2  form-group">

          <a id="publisher_image_anchor" target="_blank"><img width="70px" height="100px" id="publisher_image" src="{{asset('uploads')}}/{{$qry[0]->publisher_image}}"></a>
        </div>





        {{-- <div class="col-lg-4">
          <label>Total Clicks</label>
        <input type="text" class="form-control"  value="{{$qry[0]->total_clicks}}"  readonly="">
        </div>
         <div class="col-lg-4">
          <label>Unique Clicks</label>
        <input type="text" class="form-control" value="{{$qry[0]->unique_clicks}}"  readonly="">
        </div>
         <div class="col-lg-4">
          <label> Leads</label>
        <input type="text" class="form-control" value="{{$qry[0]->total_leads}}"  readonly="">
        </div>
         <div class="col-lg-4">
          <label>Total Earnings</label>
        <input type="text" class="form-control" value="{{round($qry[0]->total_earnings,3)}}"  readonly="">
        </div>
         <div class="col-lg-4">
          <label>Total withdrawl Amt</label>
        <input type="text" class="form-control" value="{{round($qry[0]->total_withdrawn,3)}}"  readonly="">
        </div>
         <div class="col-lg-4">
          <label>No Of Withdrawl </label>
        <input type="text" class="form-control" value="{{round($qry[0]->no_of_withdrawl,3)}}"  readonly="">
        </div>
         <div class="col-lg-4">
          <label>Locked Withdrawl</label>
        <input type="text" class="form-control"  value="{{round($qry[0]->locked_withdrawl,3)}}"  readonly="">
        </div>
            <div class="col-lg-4">
          <label>Cancelled Withdrawl</label>
        <input type="text" class="form-control" value="{{round($qry[0]->cancelled_withdrawl,3)}}"  readonly="true">
        </div>
          <?php $rank=DB::select("SELECT (DENSE_RANK() OVER(ORDER BY sum(r.total_earnings) DESC )) as rank  ,r.id from publishers as r  group by r.id order by rank ");
          $monthly_rank=DB::select("SELECT (DENSE_RANK() OVER(ORDER BY sum(r.total_earnings) DESC )) as rank  ,r.id from publishers as r  where r.created_at>=date('Y-m-01 00:00:00') group by r.id order by rank ");

                  foreach($rank as $r){
                    if($r->id==$qry[0]->id){?>
   <div class="col-lg-4">
          <label>Global Ranking</label>
        <input type="text"  value="{{$r->rank}}" class="form-control" readonly="">
        </div>
<?php }}?>
           <div class="col-lg-4">
          <label>Current Ranking</label>
          <?php
           foreach($monthly_rank as $r){
                    if($r->id==$qry[0]->id){?>
        <input type="text" value="{{$r->rank}}" class="form-control" readonly="">
        <?php }}?>
        </div> --}}






        <div class="col-lg-12 mt-2">
   <button type="submit" class="btn btn-primary" >Update</button>
      </div>

      </div>



 </form>
<!-- End Edit MODAL -->

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

//EDIT DATA
  @if(Session::has('success'))
       Swal.fire({
  title: '{{Session::get("success")}}',


  confirmButtonText: 'Ok'
})
             @endif


// $.ajax({
//   method:'get',
//   data:{id:'{{$id}}'},
//   url:'<?php echo url('admin/edit-publishers')?>',
//   async:false,
//   dataType:'json',
//   success:function(res){
//      $('#editModal').modal('show');

//         $('input[name=name1]').val(res.name);
//         $('input[name=email1]').val(res.email);
//         $('input[name=address1]').val(res.address);
//         $('input[name=city1]').val(res.city);

//         $('input[name=region1]').val(res.region);
//         $('select[name=status1]').val(res.status);
//          $('select[name=affliate_manager1]').val(res.affliate_manager_id);

//         $('select[name=countries1]').val(res.country);
// $('input[name=hidden_img]').val(res.publisher_image);
//  $('#publisher_image').attr('src','<?php echo asset('uploads/')?>/'+res.publisher_image+'')
//   $('#publisher_image_anchor').attr('href','<?php echo asset('uploads/')?>/'+res.publisher_image+'')
//       $('#id').val(res.id);
//     },
// })


  })
</script>
