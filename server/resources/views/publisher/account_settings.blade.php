@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

 <?php $qry=DB::table('publishers')->where('id',Auth::guard('publisher')->id())->first();

 ?>

           <div class="page-content-wrapper">
        <div class="page-content">
    <?php
          if($qry->address=='' || $qry->city=='' || $qry->skype=='' || $qry->region=='' || $qry->postal_code=='' || $qry->website_url=='' || $qry->monthly_traffic=='' || $qry->publisher_image=='' || $qry->phone=='' || $qry->nid=='' || $qry->tax_file=='' || $qry->tax_note=='' || $qry->payment_terms==''  ){
echo "<div class='alert alert-danger'>Please Complete your Profile.</div>";
          }?>
                          @if($errors->any())
   <script>alert('{!! implode('', $errors->all(':message')) !!}')</script>

@endif
          <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">User Profile</div>
            <div class="pl-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-home-alt'></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
              </nav>
            </div>
            <div class="ml-auto">

            </div>
          </div>
          <!--end breadcrumb-->
          <div class="user-profile-page">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-5 border-right">

                    <div class="d-md-flex align-items-center">
                      <div class="mb-md-0 mb-3">
                        <form id="form1" action="{{url('publisher/upload-image')}}" method="post" enctype="multipart/form-data">
                     <p><input type="file"   name="file" id="file"   style="display: none;"></p>
<p><label for="file" style="cursor: pointer;">


    <?php
    if(Auth::guard('publisher')->user()->publisher_image!=null){
      ?>
    <img src="{{asset('uploads')}}/{{Auth::guard('publisher')->user()->publisher_image}}" class="rounded-circle shadow" width="130" height="130" alt="">
   <?php
}
   else
      {
          ?>
      <img src="{{$site_settings->cdn_url}}site/dashboard_assets/images/avatars/avatar-1.png" class="rounded-circle shadow" width="130" height="130" alt="">
              <?php }?>

</label></p>

         </form>
                      </div>
                      <div class="ml-md-4 flex-grow-1">
                        <div class="d-flex align-items-center mb-1">
                          <h4 class="mb-0">{{$qry->name}}</h4>


                        </div>
                        <p class="mb-0 text-muted">{{$qry->email}}</p>
                        <p class="text-primary"><i class='bx bx-buildings'></i><?php
                          if($qry->total_earnings<10){
                            echo "Beginner";
                          }
                          else if($qry->total_earnings>=10 && $qry->total_earnings<35){
                            echo "Expert";
                          }
                        else if($qry->total_earnings>=35 && $qry->total_earnings<100){
                            echo "Genious";
                        }
                          else if($qry->total_earnings>=100 && $qry->total_earnings<1000){
                          echo "Boss";
                        }
                          else if($qry->total_earnings>=1000 && $qry->total_earnings<15000){
                            echo "Rock";
                        }
                          else if($qry->total_earnings>=15000){
                              echo "Superman";
                          }
                          ?>
                      </p>

                      </div>
                    </div>
                  </div>

              <!--     <div class="col-12 col-lg-4 border-right">
                    <table class="table table-sm table-borderless mt-md-0 mt-3">
                      <tbody>
                        <tr>
                          <th>Availability:</th>
                          <td> <span class="badge badge-success">available</span>
                          </td>
                        </tr>
                        <tr>
                          <th>Account Type:</th>
                          <td>{{$qry->account_type}}</td>
                        </tr>
                        <tr>
                          <th>Address:</th>
                          <td>{{$qry->address}}</td>
                        </tr>
                        <tr>
                          <th>Country:</th>
                          <td>{{$qry->country}}</td>
                        </tr>
                      </tbody>
                    </table>
                   </div> -->

                   <div class="col-lg-2 text-center m-auto">
                    <div class="card radius-10 bg-voilet  text-center">
              <div class="card-body px-0">
                <div class="text-center">
                  <div class="font-60 text-white">
                  </div>
                  <h4 class="mb-0 text-white">${{round($qry->balance,2)}}</h4>
                  <p class="mb-0 text-white">Current Balance</p>
                </div>
              </div></div>
            </div>
               <div class="col-lg-2 text-center m-auto">
               <div class="card radius-10 bg-voilet  text-center">
              <div class="card-body px-0">
                <div class="text-center">
                  <div class="font-60 text-white">
                  </div>
                  <h4 class="mb-0 text-white">${{round($qry->total_earnings,2)}}</h4>
                  <p class="mb-0 text-white">Total Earnings</p>
                </div>
              </div></div>
            </div>
               <div class="col-lg-2 text-center m-auto">
               <div class="card radius-10 bg-voilet  text-center">
              <div class="card-body px-0">
                <div class="text-center">
                  <div class="font-60 text-white">
                  </div>
                  <?php $rank=DB::select("SELECT (DENSE_RANK() OVER(ORDER BY sum(r.total_earnings) DESC )) as rank  ,r.id from publishers as r  group by r.id order by rank ");

                  foreach($rank as $r){
                    if($r->id==Auth::guard('publisher')->id()){?>

 <h4 class="mb-0 text-white">{{$r->rank}}</h4>
<?php }}?>
                  <p class="mb-0 text-white">Ranking Number</p>
                </div>
              </div></div>
            </div>

                </div>
                <!--end row-->
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <ul class="nav nav-tabs">

                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#Edt-Profile"><span class="p-tab-name">Edit Profile</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                                    <div class="tab-content">

                  <div >
                    <div class="card shadow-none border mb-0">
                      <div class="card-body">
                        <div class="form-body">

                          <div class="row">

                            <div class="col-12 col-lg-5 border-right">
                           <form id="form2" action="{{url('publisher/change-password')}}" method="post">

                               @csrf <div class="form-group  ">
                                  <label><b> Password</b></label>
                                  <input type="password" name="password"  class="form-control">
                                </div>


                              <div class="form-group  ">
                                  <label><b>Confirm Password</b></label>
                                  <input type="password" name="confirm_password"  class="form-control">
                                </div>
                                  <div class="form-group  ">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                  </div>
   </form>

                            </div>

                            <div class="col-12 col-lg-7">
  <form id="form3" action="{{url('publisher/update-settings')}}" method="post" enctype="multipart/form-data">

                               @csrf
                              <div class="form-row">

                                <div class="form-group col-lg-6">
                                  <label><b> Name</b></label>
                                  <input type="text" value="{{$qry->name}}" name="name" class="form-control">
                                </div>

                               <div class="col-lg-6   " >
                                           <label><b>Phone</b></label>
                                        <div class="form-group"  >

                                        <select class="form-control" name="phone_code"   style="width: 30%;float: left;" >


                <?php
        $q=DB::table('countries')->get();

        foreach($q as $q){
            ?>
            <option value="{{$q->phonecode}}" {{$q->phonecode==$qry->phone_code?'selected':null}}>{{$q->phonecode}}-{{$q->country_name}}</option>
        <?php }?>



</select>
               <input type="number" placeholder="Enter Phone Number " style="width: 70%;float: left" class="form-control" value="{{$qry->phone}}" name="phone">

                                    </div>
                                  </div>


                              <div class="form-group col-lg-6">
                                <label><b>Address</b></label>
                                <input type="text" value="{{$qry->address}}" name="address" class="form-control">
                              </div>
                              <div class="form-group col-lg-6">
                                <label><b>Region</b></label>
                                <input type="text" value="{{$qry->region}}" name="region" class="form-control">
                              </div>

                                <div class="form-group col-lg-6">
                                <label><b>City</b></label>
                                <input type="text" value="{{$qry->city}}" name="city" class="form-control">
                              </div>
                                  <div class="col-lg-6  col-lg-6" >
                                        <div class="form-group"  >
                                            <label><b>Zip/Postal Code</b></label>
                                           <input type="text" placeholder="Enter Zip/Postal Code" class="form-control " value="{{$qry->postal_code}}" name="zip">

                                    </div>
                                  </div>
                                   <div class="col-lg-6" >
                                        <div class="form-group"  >
                                            <label><b>Skype</b></label>
                                           <input type="text" placeholder="Enter Skype Name " class="form-control @error('skype') is-invalid @enderror"  value="{{$qry->skype}}" name="skype">

                                    </div>
                                  </div>
                                    <div class="col-lg-6  " >
                                        <div class="form-group"  >
                                            <label><b>Website Url</b></label>
                                           <input type="text" placeholder="Enter Website Url " class="form-control "  value="{{$qry->website_url}}" name="website_url">

                                    </div>
                                  </div>


      <div class="col-lg-6  " >
                                        <div class="form-group"  >
                                            <label><b>Monthly Traffic</b></label>

                                              <select  class="form-control @error('monthly_traffic') is-invalid @enderror"  value="{{$qry->monthly_traffic}}" name="monthly_traffic"  >
            <option value="" >Select  Traffic</option>
            <option value="Less than 1k" {{'Less than 1k'==$qry->monthly_traffic?'selected':null}}>Less than 1k</option>
            <option value="1K to 5K" {{'1K to 5K'==$qry->monthly_traffic?'selected':null}}>1K to 5K</option>
              <option value="5K to 10K" {{'5K to 10K'==$qry->monthly_traffic?'selected':null}}>5K to 10K</option>
              <option value="10K to 50K" {{'10K to 50K'==$qry->monthly_traffic?'selected':null}}>10K to 50K</option>
              <option value="50K  to 100K" {{'50K  to 100K '==$qry->monthly_traffic?'selected':null}}>50K  to 100K</option>
              <option value="100K to 1M" {{'100K to 1M'==$qry->monthly_traffic?'selected':null}}>100K to 1M</option>
              <option value="More than 1 M" {{'More than 1 M'==$qry->monthly_traffic?'selected':null}}>More than 1 M</option>



                                   </select>
                                    </div>
                                  </div>

  <div class="col-lg-6  " >
                                        <div class="form-group"  >
                                                <label><b>Site Category</b></label>
                                  <select  name="category" class="form-control @error('category') is-invalid @enderror"   value="{{$qry->category}}">
            <option value="">Select  Category</option>
               <option value="Adult" {{'Adult'==$qry->category?'selected':null}}>Adult</option>
                  <option value="Not Adult" {{'Not Adult'==$qry->category?'selected':null}}>Not Adult</option>
            <?php
        $q=DB::table('category')->where('is_deleted','0')->get();
        foreach($q as $q){?>
    <option value="{{$q->category_name}}" {{$q->category_name==$qry->category?'selected':null}}>{{$q->category_name}}</option>

  <?php }
  ?>        </select>
</div>
</div>
       <div class="col-lg-12 " >
         For USA Person Complete this form <b style="color:blue;"><a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" target="_blank">W9 Form</a></b> . If are you not from USA then  Complete this form <b style="color:green;"><a href="https://www.irs.gov/pub/irs-pdf/fw8ben.pdf" target="_blank">W8BEN Form</a></b> . After Fiiling the form. Please download and upload it  blew.
                                        <div class="form-group"  >
                                            <label><b>Tax</b></label>
                                           <input type="file" placeholder="Enter Website Url " class="form-control "  name="tax_file" accept="image/gif, image/jpeg, image/png">
                                         </div>
                                            <div class="form-group"  >
                                             <label c><b>Tax Note</b></label>
                                           <textarea name="tax_note" value="{{$qry->tax_note}}" class="form-control">{{$qry->tax_note}}</textarea>
                                           @if($qry->tax_file!='')
                                           <a type="button" class="btn btn-info mt-2" download href="{{url('uploads/')}}/{{$qry->tax_file}}">Download Submitted File </a>
                                           @endif

                                    </div>
                                  </div>
       <div class="col-lg-12  " >
                                        <div class="form-group"  >
                                            <label><b>NID/PASSPORT</b></label>
                                           <input type="file" placeholder="Enter Website Url " class="form-control "  name="nid" accept="image/gif, image/jpeg, image/png">
                                           @if($qry->nid!='')
                                           <a href="{{url('uploads/')}}/{{$qry->nid}}" type="button" class="btn btn-success mt-2" download >Download Nid/Passport</a>
                                           @endif

                                    </div>
                                  </div>
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label><b>Payment Term</b></label>
                          <input type="text" name="" disabled="" value="{{$qry->payment_terms}}" class="form-control">
                                            </div>
                                        </div>
                                     <div class="col-lg-12  " >
<div class="form-group text-center">
  <button  type="submit" class="btn btn-primary">Save Changes</button>
</div>
</div>

 </div>
</form>

                                <div class="row" id="showdata">
                                  <?php
                                  $payment=DB::table('publisher_payment_method')->where('publisher_id',$qry->id)->get();?>
                                   @foreach($payment as $p)

                                  <div class="col-12 col-lg-6 mb-3">
                                    <div class="card shadow-none border mb-3 mb-md-0">
                                      <div class="card-body">
                                        <div class="media align-items-center">
                                          <div class="col-lg-5 text-center" >
                                          @if($p->payment_type=='Paypal')
                                          <img src="{{url('assets/img/paypal.png')}}"   height="50" width='100%' alt="">
                                            @elseif($p->payment_type=='Skrill')
                                          <img src="{{url('assets/img/skrill.png')}}"   height="50"   width='100%'  alt="">
                                              @elseif($p->payment_type=='Bitcoin')
                                          <img src="{{url('assets/img/bitcoin.png')}}"   height="50"  width='100%'  alt="">
                                              @elseif($p->payment_type=='Payoneer')
                                          <img src="{{url('assets/img/payoneer.png')}}"   height="50"  width='100%' alt="">
                                           @elseif($p->payment_type=='Web Money')
                                          <img src="{{url('assets/img/webmoney.png')}}"   height="50"  width='100%' alt="">

                                            @elseif($p->payment_type=='Bank Wire')
                                          <img src="{{url('assets/img/bankwire.png')}}"   height="50"  width='100%' alt="">
                                          @endif
                                        </div>
                                          <div class="media-body ml-2">

                                            <h6 class="mb-0 ">{{$p->payment_details}}</h6>
                                             <p class="text-warning">{{$p->created_at}}</p>
                                             <p class="text-primary">{{$p->is_primary==1?'Primary':''}}</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="card-footer bg-transparent "><!-- <a href="javaScript:;" class="text-primary   ml-auto" data="{{$p->id}}">View</a> --> <a href="javaScript:;" class="text-danger  removepayment"  style="float:right" data="{{$p->id}}">REMOVE</a>
                                      </div>
                                    </div>
                                  </div>

                                 @endforeach

                                    <div class="col-12 col-lg-6 text-center">

                                     <div class="icon-box qp0pm4-0 pByfF border addPayment" style="width: 96%"  tabindex="375" data-target="#addModal" data-toggle="modal">
              <div class="icon-box-inner">
                <div class="icon-base"> <i class="fadeIn animated bx bx-plus"></i>
                </div>
                <div class="icon-box-name">Add Payment</div>

                                          </div>
                                        </div>
                                      </div>

                                    </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>



<!-- ADD MODAL -->
    <form id="form1" method="post" action="{{url('publisher/add-payment')}}">
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add   Site</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            @csrf
      <label > Select Payment Method</label>

<select class="form-control" name="payment_type">
  <option value="">Select</option>
  <option value="Paypal">Paypal</option>
  <option value="Payoneer">Payoneer</option>
  <option value="Skrill">Skrill</option>
   <option value="Bitcoin">Bitcoin</option>
     <option value="Web Money">Web Money</option>
     <option value="Bank Wire">Bank Wire</option>
</select>
  <label > Payment Details</label>
     <textarea type="text" name="payment_details"  class="form-control" ></textarea>
       <label class="mt-2">Make Primary Account</label>
       <input type="checkbox"  name="primary" value="1">

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- End ADD MODAL -->

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


$('#showdata').on('click','.removepayment',function(){
  var id=$(this).attr('data');

var r = confirm("Do you want to remove this Method!");
if (r == true) {

 window.location.href='<?php echo url('publisher/remove-payment')?>/'+id+'';

}
})
  $('#file').change(function(){

        var formdata=new FormData();

        formdata.append('file',this.files[0]);

        var url="{{url('publisher/upload-image')}}";
        $('#form1').submit();

//         $.ajax({
//        type:'ajax',

//     type:'post',
//     data:formdata,

//           contentType:false,
//               cache:false,

//         processData:false,
//     url:url,

//     async:false,

//         success:function(res){
//    console.log(res);
//        // window.location.reload();
//         }

// });
});
})
</script>
