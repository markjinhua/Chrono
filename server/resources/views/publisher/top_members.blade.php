
@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

 
 
     		<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
			 
					</div>
					<!--end breadcrumb-->
	<?php
    
 
                  $rank=DB::select("SELECT (DENSE_RANK() OVER(ORDER BY sum(r.total_earnings) DESC )) as rank  ,r.id from publishers as r  group by r.id order by rank ");

 

			$month=date('Y-m-01 00:00:00');
		$this_month=DB::select("SELECT (DENSE_RANK() OVER(ORDER BY sum(r.earnings) DESC )) as rank  ,r.publisher_id,sum(r.earnings) as earnings,p.publisher_image,sum(r.lead) as leads,p.name,sum(r.clicks) as clicks,(select sum(earnings) from ranking where publisher_id=p.id) as total_earnings,(select sum(lead) from ranking where publisher_id=p.id) as total_leads,p.total_earnings as publisher_earnings FROM ranking as r,publishers as p where r.created_at>='$month' and p.id=r.publisher_id  group by r.publisher_id order by rank ");

$clicks=DB::select("SELECT count(id) as clicks,publisher_id FROM `offer_process` where created_at>='$month' group by publisher_id ");



	$lastmonth=date("Y-m-01 00:00:00",strtotime("-1 month"));
		$lastmonthdate = date('Y-m-t 23:59:59', strtotime('-1 months'));
 
		$last_month=DB::select("SELECT (DENSE_RANK() OVER(ORDER BY sum(r.earnings) DESC )) as rank  ,r.publisher_id,sum(r.earnings) as earnings,p.publisher_image,sum(r.lead) as leads,p.name,sum(r.clicks) as clicks,(select sum(earnings) from ranking where publisher_id=p.id) as total_earnings,p.total_earnings as publisher_earnings,(select sum(lead) from ranking where publisher_id=p.id) as total_leads FROM ranking as r,publishers as p where (r.created_at>='$lastmonth' and r.created_at<='$lastmonthdate') and p.id=r.publisher_id  group by r.publisher_id order by rank ");
		 
$last_clicks=DB::select("SELECT count(id) as clicks,publisher_id FROM `offer_process` where created_at>='$lastmonth' and created_at<='$lastmonthdate' group by publisher_id ");




$total_clicks=DB::select("SELECT count(id) as clicks,publisher_id FROM `offer_process`  group by publisher_id ");
?>
<div class="row">
	<div class="col-lg-6">
		<div class="col-lg-12">
			<div class="card">
								<div class="card-body text-center">
			 <h3>Top Members (This Month)</h3>
			</div>
		</div>
		</div>
		<?php $count=0;?>
@foreach($this_month as $d)
<?php
$count++;

?>

@if($count<=10)
						<div class="col-lg-12" >
							<div class="card">
								<div class="card-body">
									<div class="media align-items-center">
											@if($d->publisher_image!=null)

							<img src="{{asset('uploads/')}}/{{$d->publisher_image}}" width="80" height="80" class="rounded-circle p-1 border" alt="" />			
										@else
	<img src="https://xbladecdn.b-cdn.net/cnew/site/dashboard_assets/images/avatars/avatar-1.png" width="80" height="80" class="rounded-circle p-1 border" alt="" />
	@endif
										<div class="media-body ml-3">
											<h5 class="mb-0">{{$d->name}} ({{$d->publisher_id}})</h5>
											<p class="mb-0 text-secondary"> </p>
                                        <p class="designattion mb-0"><?php 
                          if($d->publisher_earnings<10){
                            echo "<div class='badge badge-light'>Beginner</div>";
                          }
                          else if($d->publisher_earnings>=10 && $d->publisher_earnings<35){
                            echo "<div class='badge badge-info'>Expert</div>";
                          }
                        else if($d->publisher_earnings>=35 && $d->publisher_earnings<100){
                            echo "<div class='badge badge-warning'>Genious</div>";
                        }
                          else if($d->publisher_earnings>=100 && $d->publisher_earnings<1000){
                          echo "<div class='badge badge-dark'>Boss</div>";
                        }
                          else if($d->publisher_earnings>=1000 && $d->publisher_earnings<15000){
                            echo "<div class='badge badge-danger'>Rock</div>";
                        }
                          else if($d->publisher_earnings>=15000){
                              echo "<div class='badge badge-success'>Superman</div>";
                          }
                          ?></p>
											<div class="list-inline contacts-social mt-2">
												<div>
 <span class="mr-2"><b> Leads : </b>{{$d->leads==null?0:$d->leads}}</span><br> <span class="mr-2"><b> Clicks :  </b><?php
 foreach ($clicks as $c) {
 	 if($c->publisher_id==$d->publisher_id){
 	 	echo $c->clicks;
 	 }
 }



 ?> </span><br> <span><b> Earnings : </b>${{$d->earnings==null?0:round($d->earnings,2)}}</span>
 
 
   </div>

 <span class="mr-2"><b> Total Leads : </b>{{$d->total_leads==null?0:$d->total_leads}}</span><br> <span class="mr-2"><b>Total Clicks :</b><?php
 foreach ($total_clicks as $c) {
 	 if($c->publisher_id==$d->publisher_id){
 	 	echo $c->clicks;
 	 }
 }



 ?> </span><br>  <span><b>Total Earnings :</b> ${{$d->total_earnings==null?0:round($d->total_earnings,2)}}</span>
											</div>
										</div>
												  <div class="col-lg-5">
               <div class="card radius-10 bg-info  text-center " style="width: 49%;float:left">
              <div class="card-body">
                <div class="text-center">
                  <div class="font-60 text-white"> 
                  </div>
 
 <h1 class="mb-0 text-white">{{$d->rank}}</h1>
 
                  <p class="mb-0 text-white"> CRN</p>
                </div>
              </div></div>
           
               <div class="card radius-10   text-center"  style="width: 49%;float:right;background-color: #11a976">
              <div class="card-body">
                <div class="text-center">
                  <div class="font-60 text-white"> 
                  </div>
@foreach($rank as $r)
@if($r->id==$d->publisher_id)
 <h1 class="mb-0 text-white">{{$r->rank}}</h1>
 @endif
 @endforeach
                  <p class="mb-0 text-white"> GRN</p>
                </div>
              </div></div>
            </div>
					
									</div>
								</div>
							</div>
					 </div>
			@endif		 
@endforeach
</div>

<div class="col-lg-6">



	<div class="col-lg-12">
			<div class="card">
								<div class="card-body text-center">
			 <h3>Top Members (Last Month)</h3>
			</div>
		</div>
</div>
				<?php $count=0;?>
@foreach($last_month as $d)
<?php
$count++;

?>

@if($count<=10)
						<div class="col-lg-12" >
							<div class="card">
								<div class="card-body">
									<div class="media align-items-center">
								 
										@if($d->publisher_image!=null)

							<img src="{{asset('uploads/')}}/{{$d->publisher_image}}" width="80" height="80" class="rounded-circle p-1 border" alt="" />			
										@else
	<img src="{{asset('dashboard_assets/images/avatars/avatar-1.png')}}" width="80" height="80" class="rounded-circle p-1 border" alt="" />
	@endif
										<div class="media-body ml-3">
											<h5 class="mb-0">{{$d->name}} ({{$d->publisher_id}})</h5>
											<p class="mb-0 text-secondary"> </p>
                                        <p class="designattion mb-0"><?php 
                          if($d->publisher_earnings<10){
                            echo "<div class='badge badge-light'>Beginner</div>";
                          }
                          else if($d->publisher_earnings>=10 && $d->publisher_earnings<35){
                            echo "<div class='badge badge-info'>Expert</div>";
                          }
                        else if($d->publisher_earnings>=35 && $d->publisher_earnings<100){
                            echo "<div class='badge badge-warning'>Genious</div>";
                        }
                          else if($d->publisher_earnings>=100 && $d->publisher_earnings<1000){
                          echo "<div class='badge badge-dark'>Boss</div>";
                        }
                          else if($d->publisher_earnings>=1000 && $d->publisher_earnings<15000){
                            echo "<div class='badge badge-danger'>Rock</div>";
                        }
                          else if($d->publisher_earnings>=15000){
                              echo "<div class='badge badge-success'>Superman</div>";
                          }
                          ?></p>
											<div class="list-inline contacts-social mt-2">
												<div>
 <span class="mr-2"><b> Leads : </b>{{$d->leads==null?0:$d->leads}}</span><br> <span class="mr-2"><b> Clicks :  </b><?php
 foreach ($last_clicks as $c) {
 	 if($c->publisher_id==$d->publisher_id){
 	 	echo $c->clicks;
 	 }
 }



 ?> </span><br> <span><b> Earnings : </b>${{$d->earnings==null?0:round($d->earnings,2)}}</span>
 
 
   </div>

 <span class="mr-2"><b> Total Leads : </b>{{$d->total_leads==null?0:$d->total_leads}}</span> <br><span class="mr-2"><b>Total Clicks :</b><?php
 foreach ($total_clicks as $c) {
 	 if($c->publisher_id==$d->publisher_id){
 	 	echo $c->clicks;
 	 }
 }



 ?> </span><br> <span><b>Total Earnings :</b> ${{$d->total_earnings==null?0:round($d->total_earnings,2)}}</span>
											</div>
										</div>
												  <div class="col-lg-5">
               <div class="card radius-10 bg-info  text-center " style="width: 49%;float:left">
              <div class="card-body">
                <div class="text-center">
                  <div class="font-60 text-white"> 
                  </div>
 
 <h1 class="mb-0 text-white">{{$d->rank}}</h1>
 
                  <p class="mb-0 text-white"> CRN</p>
                </div>
              </div></div>
           
               <div class="card radius-10   text-center"  style="width: 49%;float:right;background-color: #11a976">
              <div class="card-body">
                <div class="text-center">
                  <div class="font-60 text-white"> 
                  </div>
@foreach($rank as $r)
@if($r->id==$d->publisher_id)
 <h1 class="mb-0 text-white">{{$r->rank}}</h1>
 @endif
 @endforeach
                  <p class="mb-0 text-white"> GRN</p>
                </div>
              </div></div>
            </div>
					
									</div>
								</div>
							</div>
					 </div>
			@endif		 
@endforeach		</div>

 


</div>

				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
            @endsection('content')