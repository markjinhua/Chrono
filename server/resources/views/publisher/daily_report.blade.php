
	@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')		<!--page-content-wrapper-->
<?php 


$from_date = \Carbon\Carbon::parse($from_date);
$to_date = \Carbon\Carbon::parse($to_date);
// dd($from_date, $to_date);
$id=Auth::guard('publisher')->id();
$qry=DB::select("select o.offer_id,o.created_at,o.source,o.key_,o.ua_target,o.sid,o.sid2,o.sid3,o.sid4,o.sid5,o.country as countries,o.ip_address as ip_address,o.offer_id ,o.browser,o.offer_name,
(select count(id) from offer_process where publisher_id='$id' and created_at>='$from_date' and created_at<='$to_date') as total_clicks,(select count(id) from offer_process where id=o.id and created_at>='$from_date' and created_at<='$to_date') as clicks
,(select count(id) from offer_process where id=o.id and status='Approved' and created_at>='$from_date' and created_at<='$to_date') as leads
,(select sum(publisher_earned) from offer_process where id=o.id and status='Approved' and created_at>='$from_date' and created_at<='$to_date') 
as earnings  from offer_process as o where o.publisher_id='$id' and o.created_at>='$from_date' and o.created_at<='$to_date'  order by o.id desc" );
$qry1=DB::select("select o.offer_id,o.created_at,group_concat(distinct(o.country)) as countries,group_concat(distinct(o.ip_address)) as ip_address,group_concat(distinct(o.offer_id)) as offer_id,group_concat(distinct(o.browser)) as browser,(select count(id) from offer_process where publisher_id='$id' and o.created_at=created_at  and created_at>='$from_date' and created_at<='$to_date') as clicks,(select count(id) from offer_process where  publisher_id='$id' and o.created_at=created_at and status='Approved' and created_at>='$from_date' and created_at<='$to_date') as leads,(select sum(publisher_earned) from offer_process where publisher_id='$id' and o.created_at=created_at and status='Approved' and created_at>='$from_date' and created_at<='$to_date') as earnings  from offer_process as o where o.publisher_id='$id'  GROUP by date(o.created_at)" );


?>
<style>
    
</style>
			<div class="page-content-wrapper">
				<div class="page-content">
				
				 		<div class="card radius-10">

								<div class="card-body">
										<form action="{{url('publisher/show-daily-report')}}" method="get">
									 <div class="row">
									<div class="col-lg-3">

									<div class="form-group">
										<label>From Date</label>
											<input type="date" name="from_date" value="{{substr($from_date,0,10)}}" class="form-control"  >
										</div>
									</div>
										<div class="col-lg-3">
								<div class="form-group">
										 <label>To Date</label>
											<input class="form-control" value="{{substr($to_date,0,10)}}"  name="to_date" type="date">
										</div>
									</div>
							 
									<div class="col-lg-2">
										<button class="btn btn-primary" type="submit" style="margin-top: 28px">Filter</button>
									</div>
									</div>
								</form>
								</div>
				 </div>
			 
	<!--end row-->
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card radius-10">
									<div class="card-header">
				 				Report By Offers
				 			</div>
								<div class="card-body ">
									<div class="table-responsive">
								<table class="table table-bordered table-sm table-striped w-100" id="example2">
									<thead>
									 
										 
											 
										<th>Date</th>
											<th>Offer</th>
												<th>Countries</th>
												<th>Browsers</th>
												<th>IP Address</th>
												<th>Device</th>
												
													<th>Smartlink(ID)</th>
													<th>Source</th>
													<th>SID</th>
													<th>SID2</th>
													<th>SID3</th>
													<th>SID4</th>
													<th>SID5</th>
                                                
													
										 
										<th>Clicks</th>
										<th>Leads</th>
										<th>Earnings</th>
											<th>CR</th>
												<th>ECPM</th>

									</thead>
									<tbody>
									    <?php
									    $click=0;
									    $leads=0;
									    $earnings=0;
									    ?>
									 
										@foreach($qry as $q)
										<?php $click+=$q->clicks;
										 $leads+=$q->leads;
										  $earnings+=$q->earnings;?>
										<tr>
										 
											<td>{{$q->created_at}}</td>
											<td>{{$q->offer_name}}({{$q->offer_id}})</td>
											<td>{{$q->countries}}</td>
												<td>    @if($q->browser=='OPERA MINI')
 
                                        <i class="lni lni-opera" title="Opera"></i>
                        @elseif($q->browser=='Chrome')
                      <i class="fadeIn animated lni lni-chrome" title="Chrome"></i>
                        @elseif($q->browser=='Firefox')
                          <i class="fadeIn animated lni lni-firefox" title="Firefox"></i>
                        @elseif($q->browser=='Internet Explorer')
                        <i class="lni lni-dribbble" title="Internet Explorer"></i>
                        @elseif($q->browser=='Safari')
                        <i class="fadeIn animated lni lni-shortcode" title="Safari"></i>
                           @elseif($q->browser=='EDGE')
                        <i class="fadeIn animated lni lni-edge" title="Edge"></i>
                        @endif
</td>
													<td>{{$q->ip_address}}</td>
													 <?php if($q->key_==null){?>
														<td> 
														            
                                        @if($q->ua_target=='Windows')

                                        <i class="lni lni-windows" title="Windows"></i>
                        @elseif($q->ua_target=='Mac')
                      <i class="fadeIn animated bx bx-laptop" title="Mac"></i>
                        @elseif($q->ua_target=='Iphone')
                          <i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
                        @elseif($q->ua_target=='Ipad')
                        <i class="lni lni-tab" title="Ipad"></i>
                        @elseif($q->ua_target=='Android')
                        <i class="fadeIn animated bx bx-mobile" title="Android"></i>
                        @endif</td>
														<td style="background:#F2F2F2;"></td>	 
														<td>
														     <?php if($q->source==null){?>
														   Direct Visitor
														    <?php }
														    
														    else{
                                                    ?>
                                                   	 {{$q->source}}
                                                   	
                                                
														     <?php      } ?>
														    </td>
														   
														<td>{{$q->sid}}</td>
														<td>{{$q->sid2}}</td>
														<td>{{$q->sid3}}</td>
														<td>{{$q->sid4}}</td>
														<td>{{$q->sid5}}</td>
														
                                                 <?php }
                                                          else{
                                                    ?>
                                                    <td> 
														            
                                        @if($q->ua_target=='Windows')

                                        <i class="lni lni-windows" title="Windows"></i>
                        @elseif($q->ua_target=='Mac')
                      <i class="fadeIn animated bx bx-laptop" title="Mac"></i>
                        @elseif($q->ua_target=='Iphone')
                          <i class="fadeIn animated bx bx-mobile-alt" title="Iphone"></i>
                        @elseif($q->ua_target=='Ipad')
                        <i class="lni lni-tab" title="Ipad"></i>
                        @elseif($q->ua_target=='Android')
                        <i class="fadeIn animated bx bx-mobile" title="Android"></i>
                        @endif</td>
                                                    
                                                   	<td> 
                                                   	
                                                   	
                                                   	<?php
$servername = getenv('DB_HOST');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM smartlinks WHERE key_ = '$q->key_'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["name"];
    }
} else {
    echo "Smartlink Not Available";
}

$conn->close();
?>
                                                   	
                                                   	</td>
                                                   	
                                                   	<td style="background:#F2F2F2;"></td>
                                                   	<td style="background:#F2F2F2;"></td>
                                                   	<td style="background:#F2F2F2;"></td>
                                                   	<td style="background:#F2F2F2;"></td>
                                                   	<td style="background:#F2F2F2;"></td>
                                                   	<td style="background:#F2F2F2;"></td>
                                                   	
                                                <?php      } ?>
                                                
														
											<td><b>{{$q->clicks}}</b></td>
											<td><b>{{$q->leads}}</b></td>
											<td><b>${{round($q->earnings,2)}}</b></td>
											
													<td> <b>{{$q->leads==0?0:$q->clicks/$q->leads}}%</b></td>
														<td> <b>${{$q->leads==0?0:round($q->earnings/$q->leads*1000,2)}}</b> </td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>	<tr>
									    	<td></td>
													 
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
															<td></td>
										 
											<td> </td>
											<td> </td>
											<td> </td>
											<td> </td>	<td></td>
											<td><b> Total = </b></td>
											
											<td><b>{{$click}}</b></td>
											<td><b>{{$leads}}</b></td>
											<td><b>${{round($earnings,2)}}</b></td>
										
													<td> <b>{{$leads==0?0:$click/$leads}}%</b></td>
														<td> <b>${{$leads==0?0:round($earnings/$leads*1000,2)}}</b> </td>
											 
										</tr></tfoot>
								</table>
							 
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--		<div class="row">-->
			<!--			<div class="col-12 col-lg-12">-->
			<!--				<div class="card radius-10">-->
			<!--						<div class="card-header">-->
			<!--	 				Report By Date-->
			<!--	 			</div>-->
			<!--					<div class="card-body ">-->
			<!--						<div class="table-responsive">-->
			<!--					<table class="table" id="example">-->
			<!--						<thead>-->
									 
										 
			<!--							<th>Date</th>-->
			<!--								<th>Offer</th>-->
			<!--									<th>Countries</th>-->
			<!--									<th>Browsers</th>-->
			<!--									<th>Ip Address</th>-->
										 
			<!--							<th>Clicks</th>-->
			<!--							<th>Leads</th>-->
			<!--							<th>Earnings</th>-->
								 

			<!--						</thead>-->
			<!--						<tbody>-->
			<!--							@foreach($qry1 as $q)-->
			<!--							<tr>-->
										 
			<!--								<td>{{$q->created_at}}</td>-->
			<!--								<td>{{$q->offer_id}}</td>-->
			<!--								<td>{{$q->countries}}</td>-->
			<!--									<td>{{$q->browser}}</td>-->
			<!--										<td>{{$q->ip_address}}</td>-->
			<!--								<td>{{$q->clicks}}</td>-->
			<!--								<td>{{$q->leads}}</td>-->
			<!--								<td>${{round($q->earnings,2)}}</td>-->
			<!--							</tr>-->
			<!--							@endforeach-->
			<!--						</tbody>-->
			<!--					</table>-->
			<!--				</div>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->
		 
	</div>
</div>
</div>
 
@endsection('content')