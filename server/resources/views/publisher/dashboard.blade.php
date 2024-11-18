@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')


<?php


$id=Auth::guard('publisher')->id();
?>

            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-12 col-lg-3">

                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Unique Clicks</h6>
                                            <h4 class="font-weight-bold uniqueClicks">0 <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="lni lni-pointer-up"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                              <div class="col-12 col-lg-3">

                                <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Today Leads</h6>
                                            <h4 class="font-weight-bold today_leads">0 <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="bx bx-refresh"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                            <div class="col-12 col-lg-3">

                                <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Today ECPM</h6>
                                            <h4 class="font-weight-bold today_ecpm">$0 <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="bx bx-Rocket"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Today Earnings</h6>
                                            <h4 class="font-weight-bold">${{$td_epc}} <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="bx bx-Dollar-circle"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-3">

                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Clicks</h6>
                                            <h4 class="font-weight-bold">{{$click_count}} <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="lni lni-pointer-up"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                              <div class="col-12 col-lg-3">

                                <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>CTR</h6>
                                            <h4 class="font-weight-bold">{{$ctr}}% <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="bx bx-refresh"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                            <div class="col-12 col-lg-3">

                                <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>EPC</h6>
                                            <h4 class="font-weight-bold">${{$epc}}<small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="bx bx-Rocket"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Vpn Click</h6>
                                            <h4 class="font-weight-bold">{{$publisher_table->vpn_clicks}} <small class="text-success font-small"></small></h4>
                                        </div>
                                        <div class="dashboard-icons bg-light-primary text-primary"><i class="bx bx-Dollar-circle"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end row-->

                            <div class="card radius-10">
                                <div class="card-header border-bottom-0">
                                    <div class="d-lg-flex align-items-center">
                                        <div>
                                            <h5 class="font-weight-bold mb-2 mb-lg-0">Clicks  | Conversions | Earnings</h5>
                                        </div>
                                        <div class="ml-lg-auto mb-2 mb-lg-0">
                                            <div class="btn-group-round">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="differencechart"></div>

         </div>
     </div>
     @if(Auth::guard('publisher')->user()->expert_mode==1)

     <!----- New offers ----->
<div class="card radius-10">
                                 	<div class="card-header">
    									<h5 class="mb-0">Featured Offers</h5>
    								</div>

    								<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- banner -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8033965373394508"
     data-ad-slot="4705504298"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                                        <div class="card-body">
                          @if(Auth::guard('publisher')->user()->expert_mode==1)
                            <div class="container my-4" style="border-radius: 12px;border: 2px solid #e2eaef;box-shadow: 2px;">


    <!--Carousel Wrapper-->
    <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

      <!--Controls-->
      <div class="controls-top">
        <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
        <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <!--/.Controls-->

      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
        <li data-target="#multi-item-example" data-slide-to="1"></li>
        <li data-target="#multi-item-example" data-slide-to="2"></li>
      </ol>
      <!--/.Indicators-->

      <!--Slides-->
      <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">

          <div class="row">
              <?php
                                    $id=Auth::guard('publisher')->id();
$qry=DB::select("SELECT o.offer_name,ap.approval_status,o.offer_type,c.category_name,o.countries,o.payout_percentage,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.featured_offer,o.preview_url,o.verticals,o.id as oid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where   o.status='Active' and o.offer_type!='special' and o.lockers=1  ORDER BY RAND() limit 3");


$site=DB::table('site_settings')->first();

                                        foreach($qry as $q){?>
            <div class="col-md-4" style="border-radius: 12px;">
                <center>
              <div class="card mb-2">
                <img style="height:236px;" class="card-img-top" src="uploads/{{$q->preview_url}}"
                  alt="Card image cap">
                <div class="card-body">
                  <h6 style="font-weight:bold;" class="card-title">{{$q->offer_name}}</h6>
                  <p class="card-text"><br>{{$q->category_name}}

									<br>{{$q->verticals}}</p>
									<?php  $device=explode('|',$q->ua_target);
                                                foreach($device as $d){
                                                ?>
                                            @if($d=='Windows')
										<i class="lni lni-windows" title="Windows"></i>
                                            @elseif($d=='Mac')
                                          <i class="fadeIn animated bx bx-laptop" title="Mac"></i>
                                            @elseif($d=='Iphone')
                                              <i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
                                            @elseif($d=='Ipad')
                                            <i class="lni lni-tab" title="Ipad"></i>
                                            @elseif($d=='Android')
                                            <i class="fadeIn animated bx bx-mobile" title="Android"></i>
                                            @endif
                                                <?php }?>
                                              <br>

                                               <?php  $browser=explode('|',$q->browsers);
                                        foreach($browser as $d){
                                        ?>
                                        @if($d=='OPERA MINI')
                                        <i style="color:#17a2b8;" class="lni lni-opera" title="Opera"></i>
                                        @elseif($d=='Chrome')
                                      <i style="color:#17a2b8;" class="fadeIn animated lni lni-chrome" title="Chrome"></i>
                                        @elseif($d=='Firefox')
                                          <i style="color:#17a2b8;" class="fadeIn animated lni lni-firefox" title="Firefox"></i>
                                        @elseif($d=='Internet Explorer')
                                        <i style="color:#17a2b8;" class="lni lni-dribbble" title="Internet Explorer"></i>
                                        @elseif($d=='Safari')
                                        <i style="color:#17a2b8;" class="fadeIn animated lni lni-shortcode" title="Safari"></i>
                                           @elseif($d=='EDGE')
                                        <i style="color:#17a2b8;" class="fadeIn animated lni lni-edge" title="Edge"></i>
                                        @endif
                                          <?php }?>
                  <p class="item-price"><h3 style="color: #e83fb4;font-weight: bold;"> <?php if($q->payout_type=='revshare'){?>
                                                 RevShare
                                                 <?php }
                                                          else{
                                                    ?>
                                                    ${{round(($q->payout*$q->payout_percentage)/100,2)}}
                                                    <!--${{round(($q->payout),2)}}-->
                                                <?php      } ?></h3>
                                                </p>

								 <a  class="btn btn-primary" href="{{url('publisher/offers-details')}}/{{$q->oid}}" target="_blank">Get Details</a>
                </div>
              </div>
              </center>
            </div>
<?php }
                                    ?>



          </div>

        </div>
        <!--/.First slide-->

        <!--Second slide-->
        <div class="carousel-item">

                   <div class="row">
              <?php
                                    $id=Auth::guard('publisher')->id();
$qry=DB::select("SELECT o.offer_name,ap.approval_status,o.offer_type,c.category_name,o.countries,o.payout_type,o.payout_percentage,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.featured_offer,o.preview_url,o.verticals,o.id as oid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where   o.status='Active' and o.offer_type!='special' and o.lockers=1  ORDER BY RAND() limit 3");


$site=DB::table('site_settings')->first();

                                        foreach($qry as $q){?>
            <div class="col-md-4" style="border-radius: 12px;">
                <center>
              <div class="card mb-2">
                <img style="height:236px;" class="card-img-top" src="uploads/{{$q->preview_url}}"
                  alt="Card image cap">
                <div class="card-body">
                  <h6 style="font-weight:bold;" class="card-title">{{$q->offer_name}}</h6>
                  <p class="card-text"><br>{{$q->category_name}}

									<br>{{$q->verticals}}</p>
									<?php  $device=explode('|',$q->ua_target);
                                                foreach($device as $d){
                                                ?>
                                            @if($d=='Windows')
										<i class="lni lni-windows" title="Windows"></i>
                                            @elseif($d=='Mac')
                                          <i class="fadeIn animated bx bx-laptop" title="Mac"></i>
                                            @elseif($d=='Iphone')
                                              <i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
                                            @elseif($d=='Ipad')
                                            <i class="lni lni-tab" title="Ipad"></i>
                                            @elseif($d=='Android')
                                            <i class="fadeIn animated bx bx-mobile" title="Android"></i>
                                            @endif
                                                <?php }?>
                                              <br>

                                               <?php  $browser=explode('|',$q->browsers);
                                        foreach($browser as $d){
                                        ?>
                                        @if($d=='OPERA MINI')
                                        <i style="color:#17a2b8;" class="lni lni-opera" title="Opera"></i>
                                        @elseif($d=='Chrome')
                                      <i style="color:#17a2b8;" class="fadeIn animated lni lni-chrome" title="Chrome"></i>
                                        @elseif($d=='Firefox')
                                          <i style="color:#17a2b8;" class="fadeIn animated lni lni-firefox" title="Firefox"></i>
                                        @elseif($d=='Internet Explorer')
                                        <i style="color:#17a2b8;" class="lni lni-dribbble" title="Internet Explorer"></i>
                                        @elseif($d=='Safari')
                                        <i style="color:#17a2b8;" class="fadeIn animated lni lni-shortcode" title="Safari"></i>
                                           @elseif($d=='EDGE')
                                        <i style="color:#17a2b8;" class="fadeIn animated lni lni-edge" title="Edge"></i>
                                        @endif
                                          <?php }?>
                  <p class="item-price"><h3 style="color: #e83fb4;font-weight: bold;"> <?php if($q->payout_type=='revshare'){?>
                                                 RevShare
                                                 <?php }
                                                          else{
                                                    ?>
                                                    ${{round(($q->payout*$q->payout_percentage)/100,2)}}
                                                    <!--${{round(($q->payout),2)}}-->
                                                <?php      } ?></h3>
                                                </p>

								 <a  class="btn btn-primary" href="{{url('publisher/offers-details')}}/{{$q->oid}}" target="_blank">Get Details</a>
                </div>
              </div>
              </center>
            </div>
<?php }
                                    ?>



          </div>
        </div>
        <!--/.Second slide-->

        <!--Third slide-->
        <div class="carousel-item">

                  <div class="row">
              <?php
                                    $id=Auth::guard('publisher')->id();
$qry=DB::select("SELECT o.offer_name,ap.approval_status,o.offer_type,c.category_name,o.countries,o.payout_type,o.payout_percentage,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.featured_offer,o.preview_url,o.verticals,o.id as oid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where   o.status='Active' and o.offer_type!='special' and o.lockers=1  ORDER BY RAND() limit 3");


$site=DB::table('site_settings')->first();

                                        foreach($qry as $q){?>
            <div class="col-md-4" style="border-radius: 12px;">
                <center>
              <div class="card mb-2">
                <img style="height:236px;" class="card-img-top" src="uploads/{{$q->preview_url}}"
                  alt="Card image cap">
                <div class="card-body">
                  <h6 style="font-weight:bold;" class="card-title">{{$q->offer_name}}</h6>
                  <p class="card-text"><br>{{$q->category_name}}

									<br>{{$q->verticals}}</p>
									<?php  $device=explode('|',$q->ua_target);
                                                foreach($device as $d){
                                                ?>
                                            @if($d=='Windows')
										<i class="lni lni-windows" title="Windows"></i>
                                            @elseif($d=='Mac')
                                          <i class="fadeIn animated bx bx-laptop" title="Mac"></i>
                                            @elseif($d=='Iphone')
                                              <i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
                                            @elseif($d=='Ipad')
                                            <i class="lni lni-tab" title="Ipad"></i>
                                            @elseif($d=='Android')
                                            <i class="fadeIn animated bx bx-mobile" title="Android"></i>
                                            @endif
                                                <?php }?>
                                              <br>

                                               <?php  $browser=explode('|',$q->browsers);
                                        foreach($browser as $d){
                                        ?>
                                        @if($d=='OPERA MINI')
                                        <i style="color:#17a2b8;" class="lni lni-opera" title="Opera"></i>
                                        @elseif($d=='Chrome')
                                      <i style="color:#17a2b8;" class="fadeIn animated lni lni-chrome" title="Chrome"></i>
                                        @elseif($d=='Firefox')
                                          <i style="color:#17a2b8;" class="fadeIn animated lni lni-firefox" title="Firefox"></i>
                                        @elseif($d=='Internet Explorer')
                                        <i style="color:#17a2b8;" class="lni lni-dribbble" title="Internet Explorer"></i>
                                        @elseif($d=='Safari')
                                        <i style="color:#17a2b8;" class="fadeIn animated lni lni-shortcode" title="Safari"></i>
                                           @elseif($d=='EDGE')
                                        <i style="color:#17a2b8;" class="fadeIn animated lni lni-edge" title="Edge"></i>
                                        @endif
                                          <?php }?>
                  <p class="item-price"><h3 style="color: #e83fb4;font-weight: bold;"> <?php if($q->payout_type=='revshare'){?>
                                                 RevShare
                                                 <?php }
                                                          else{
                                                    ?>
                                                   ${{round(($q->payout*$q->payout_percentage)/100,2)}}
                                                   <!--${{round(($q->payout),2)}}-->
                                                <?php      } ?></h3>
                                                </p>

								 <a  class="btn btn-primary" href="{{url('publisher/offers-details')}}/{{$q->oid}}" target="_blank">Get Details</a>
                </div>
              </div>
              </center>
            </div>
<?php }
                                    ?>



          </div>

        </div>
        <!--/.Third slide-->

      </div>
      <!--/.Slides-->

    </div>
    <!--/.Carousel Wrapper-->


  </div>

        @endif

  </div>
  </div>
     <!--------New Offer Ends -------->

      @endif






      @if(Auth::guard('publisher')->user()->expert_mode==1)


<?php


$recent_conversion=DB::table('offer_process as op')->select('o.id','o.offer_name','op.browser','op.country','op.publisher_earned','op.created_at','op.ua_target','op.payout','o.icon_url','op.ip_address')->join('offers as o','o.id','=','op.offer_id')->where('op.status','Approved')->where('op.publisher_id',$id)->orderBy('op.created_at','desc')->limit(10)->get();

?>


                    <div class="card radius-10">
                        <div class="card-header border-bottom-0">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="font-weight-bold mb-0">Recent Conversions</h5>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Preview</th>
                                            <th>(#ID)Offer Name</th>
                                            <th>Payout</th>
                                            <th>Date</th>
                                            <th>Country</th>

                                            <th>Browser</th>
                                             <th>Device</th>
                                              <th>IP Address</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($recent_conversion as $r)
                                        <tr>
                                            <td>
                                                <div class="product-img bg-transparent border">
                                                    <img src="uploads/{{$r->icon_url}}" width="35" alt="">
                                                </div>
                                            </td>
                                            <td>({{$r->id}}) - {{$r->offer_name}}</td>
                                            <td>${{round($r->publisher_earned,2)}}</td>
                                            <td>{{$r->created_at}}</td>

                                            <td>{{$r->country}}</td>
                                            <td> {{$r->browser}}</td>
                                           <td>
                                      <?php  $device=explode('|',$r->ua_target);
  foreach($device as $d){

                                        ?>
                                        @if($d=='Windows')

                                        <i class="lni lni-windows" title="Windows"></i>
                        @elseif($d=='Mac')
                      <i class="fadeIn animated bx bx-laptop" title="Mac"></i>
                        @elseif($d=='Iphone')
                          <i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
                        @elseif($d=='Ipad')
                        <i class="lni lni-tab" title="Ipad"></i>
                        @elseif($d=='Android')
                        <i class="fadeIn animated bx bx-mobile" title="Android"></i>
                        @endif
<?php }?></td>
                                              <td>{{$r->ip_address}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                     @endif
                </div>
            </div>
            <!--end page-content-wrapper-->
        </div>
        <!--end page-wrapper-->
        <!--start overlay-->
        <div class="overlay toggle-btn-mobile"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
       <!--footer -->
       @php
            $site_setting = App\SiteSetting::find(1);
        @endphp
        <div class="footer">
            <p class="mb-0">{{ $site_setting->site_name }} © 2022 | Developed By : <a href="https://dsatbd.com" target="_blank">{{ $site_setting->site_name }} </a>
            </p>
        </div>
        <!--{{ $site_setting->cdn_url }}-->
        <!-- end footer -->
    </div>
    <!-- end wrapper -->



@endsection('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript" >
    <?php
    $month_date=date('Y-m-01 00:00:00');
$diff_qry=DB::select("select (select count(id) from offer_process as ol  where ol.status='Approved' and date(ol.created_at)=date(op.created_at) and ol.publisher_id='$id' and created_at>='$month_date') as leads ,(select count(id) from offer_process as ol  where  date(ol.created_at)=date(op.created_at) and ol.publisher_id='$id'  and created_at>='$month_date') as clicks,(select sum(publisher_earned) from offer_process as ol  where  ol.publisher_id='$id' and ol.status='Approved' and date(ol.created_at)=date(op.created_at)  and created_at>='$month_date') as earnings ,op.created_at from offer_process as op  where  op.publisher_id='$id'  and created_at>='$month_date'  GROUP by  date(op.created_at) order by op.created_at asc");
 $diff_qry=json_encode($diff_qry);


?>


$(function () {
url='{{config('app.url')}}'+'/assets/ringtone/welcome.ogg';
  playSound(url);
    function playSound(url) {
  const audio = new Audio(url);
  audio.play();
}

    setInterval(GetLiveClicks,3000);
let clicks=[];
let leads=[];
let date=[];
let earnings=[];
var qry=JSON.parse('<?php echo $diff_qry ?>');



for(var i=0;i<qry.length;i++){
  if(qry[i].clicks==null){
      clicks.push(0);
  }else{
        clicks.push(qry[i].clicks);
  }

   if(qry[i].leads==null){
        leads.push(0);
   }
   else{
        leads.push(qry[i].leads);
   }
        date.push(qry[i].created_at);
        if(qry[i].earnings==null){
        earnings.push(0);
        }
        else{
        earnings.push(parseFloat(qry[i].earnings).toFixed(2));
}
}

    "use strict";
        var optionsLine = {
        chart: {
            height: 300,
            type: 'line',
            zoom: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 8,
                left: 2,
                blur: 3,
                opacity: 0.1,
            }
        },
           animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
              speed: 1000
            }
          },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ["#ff007b", '#265ED7','#00ff66'],
        series: [{
            name: "Clicks",
            data:clicks,

        }, {
            name: "Conversions",
            data: leads
        }
        , {
            name: "Earnings",
            data: earnings
        }],
        title: {
            text: 'This Month',
            align: 'left',
            offsetY: 25,
            offsetX: 20
        },
        subtitle: {
            text: 'Statistics',
            offsetY: 55,
            offsetX: 20
        },
        markers: {
            size: 4,
            strokeWidth: 0,
            hover: {
                size: 7
            }
        },
        grid: {
            show: true,
            padding: {
                bottom: 0
            }
        },

        labels:date,
        xaxis: {
            tooltip: {
                enabled: false
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -20
        }
    }
    var chartLine = new ApexCharts(document.querySelector('#differencechart'), optionsLine);
    chartLine.render();

GetLiveClicks();
var lead=0;
     function GetLiveClicks(){
$.ajax({
    method:'get',
    url:"{{url('publisher/clicks-graph')}}",
    'dataType':'json',
    success:function(res){
 if(res[0].today_leads>lead){
     url='{{config('app.url')}}'+'/assets/ringtone/lead.ogg';
     playSound(url);


 }
  lead=res[0].today_leads;

   var earnings=(res[0]!=undefined && res[0].total_earnings!=null?(parseFloat(res[0].total_earnings)).toFixed(2):'0.00');

 $('.uniqueClicks').html(res[0]!=undefined?res[0].unique_clicks:0);
  $('.today_leads').html(res[0]!=undefined?res[0].today_leads:0);
i
   $('.today_earnings').html('$'+earnings);

   $('.today_ecpm').html(res[0].today_leads!=undefined  && res[0].today_leads!=0?'$'+parseFloat(((res[0].total_earnings/res[0].today_leads)*1000)).toFixed(3):'$0.00')
    }

})
}


});
</script>
