 
	@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')		<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
				
				 		<div class="card radius-10">
				 			
								<div class="card-body">
								    <h4>STATISTICS DETAILS</h4><br>
										<form action="{{url('publisher/reports')}}" method="post">
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
								<div class="form-group">
										 <label>Type</label>
											<select name="type" class="form-control" >
												<option value="offer">Offers</option>
												<option value="smartlink" {{$type=='smartlink'?'selected':null}}>SmartLinks </option>
											</select>
										</div>
									</div>
									 
									@if($key!='')
									<div class="col-lg-2  " id="smartlinkhide">
										@else
	<div class="col-lg-2 d-none" id="smartlinkhide">
										@endif
								<div class="form-group">
										 <label>Smartlink</label>
						<?php $smartlink_type=DB::table('smartlinks')->where('publisher_id',Auth::guard('publisher')->id())->get();?>					

											 	<select name="key" class="form-control" >
												
													<option value="">Select Smartlink</option>@foreach($smartlink_type as $t)

												<option value="{{$t->key_}}" {{$key==$t->key_?'selected':null}}>{{$t->name}}</option>
														@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-2">
										<button class="btn btn-primary" type="submit" style="margin-top: 28px">Apply</button>
									</div>
									</div>
								</form>
								</div>
				 </div>
			 
<?php 

$id=Auth::guard('publisher')->id();
  $month_date=date('Y-m-01 00:00:00');
$diff_qry='';
$site=DB::table('site_settings')->first(); 
if($type=='smartlink'){
//FOR SMARTLINK OFFER QUERUES;

$diff_qry=DB::select("select (select count(id) from offer_process as ol  where ol.status='Approved' and date(ol.created_at)=date(op.created_at) and ol.publisher_id='$id'  and (created_at>='$from_date' and created_at<='$to_date') and key_='$key') as leads ,(select count(id) from offer_process as ol  where  date(ol.created_at)=date(op.created_at) and ol.publisher_id='$id'  and (created_at>='$from_date' and created_at<='$to_date') and  key_='$key') as clicks,(select sum(publisher_earned) from offer_process as ol  where  ol.publisher_id='$id' and ol.status='Approved' and date(ol.created_at)=date(op.created_at)   and (created_at>='$from_date' and created_at<='$to_date') and key_='$key') as earnings ,op.created_at from offer_process as op  where  op.publisher_id='$id'  and (created_at>='$from_date' and created_at<='$to_date') and key_='$key'  GROUP by  date(op.created_at) order by op.created_at asc");
 $diff_qry=json_encode($diff_qry);

$qry=DB::select("select *,(select payout_percentage from offers where id=offer_process.offer_id) as payout_percentage,(SELECT count(id) from offer_process where (ua_target ='windows' or  ua_target='Mac') and status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')  and key_='$key' ) as desktop,(SELECT count(id) from offer_process where (ua_target='Android' or  ua_target ='Iphone') and status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')    and key_='$key' ) as mobile ,(SELECT count(id) from offer_process where (ua_target='Ipad') and status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')   and key_='$key'  ) as tablet,(SELECT count(id) from offer_process where status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')   and key_='$key'  ) as total_rows  from offer_process where publisher_id='$id' and status='Approved'   and key_='$key' and  (created_at>='$from_date' and created_at<='$to_date') order by created_at");

$country=DB::select("SELECT count(id) as visitors,country FROM `offer_process` where publisher_id='$id' and status='Approved' and  (created_at>='$from_date' and created_at<='$to_date')   and key_='$key'  group by country");
$location=json_encode($country);

$source=DB::select("select source,count('id') as visitors from offer_process where status='Approved' and publisher_id='$id' and (created_at>='$from_date' and created_at<='$to_date')   and key_='$key' group by source ");

//END SMARTLINK OFFER QUERY




}
else{


// FOR CPA  OFFER QUERIES

$diff_qry=DB::select("select (select count(id) from offer_process as ol  where ol.status='Approved' and date(ol.created_at)=date(op.created_at) and ol.publisher_id='$id'  and (created_at>='$from_date' and created_at<='$to_date') and ol.key_ is NULL) as leads ,(select count(id) from offer_process as ol  where  date(ol.created_at)=date(op.created_at) and ol.publisher_id='$id'  and (created_at>='$from_date' and created_at<='$to_date') and ol.key_ is NULL) as clicks,(select sum(publisher_earned) from offer_process as ol  where  ol.publisher_id='$id' and ol.status='Approved' and date(ol.created_at)=date(op.created_at)   and (created_at>='$from_date' and created_at<='$to_date') and ol.key_ is NULL) as earnings ,op.created_at from offer_process as op  where  op.publisher_id='$id'  and (created_at>='$from_date' and created_at<='$to_date') and op.key_ is NULL  GROUP by  date(op.created_at) order by op.created_at asc");
 $diff_qry=json_encode($diff_qry);


$qry=DB::select("select *,(select payout_percentage from offers where id=offer_process.offer_id) as payout_percentage,(SELECT count(id) from offer_process where (ua_target ='windows' or  ua_target='Mac') and status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')  and key_ is NULL) as desktop,(SELECT count(id) from offer_process where (ua_target='Android' or  ua_target ='Iphone') and status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')    and key_ is NULL) as mobile ,(SELECT count(id) from offer_process where (ua_target='Ipad') and status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')   and key_ is NULL ) as tablet,(SELECT count(id) from offer_process where status='Approved' and publisher_id='$id' and  (created_at>='$from_date' and created_at<='$to_date')   and key_ is NULL ) as total_rows  from offer_process where publisher_id='$id' and status='Approved'   and key_ is NULL and  (created_at>='$from_date' and created_at<='$to_date') order by created_at");

$country=DB::select("SELECT count(id) as visitors,country FROM `offer_process` where publisher_id='$id' and status='Approved' and  (created_at>='$from_date' and created_at<='$to_date')    and key_ is NULL group by country");

$source=DB::select("select source,count('id') as visitors from offer_process where status='Approved' and publisher_id='$id' and (created_at>='$from_date' and created_at<='$to_date')   and key_ is NULL group by source ");

$location=json_encode($country);
}

//End CPA OFFER QUERIES
$chrome=0;
$firefox=0;
$opera=0;
$edge=0;
$safari=0;
$internet=0;
$rows=isset($qry[0]->total_rows)?$qry[0]->total_rows:1;

?>


 
					<!--end row-->
					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card radius-10">
								<div class="card-body ">
									<div class="table-responsive">
								<table class="table" id="example2">
									<thead>
										<th>SNO</th>
										<th>Offer Name(Id)</th>
										<th>Earnings</th>
										<th>Date</th>
										<th>Country</th>
										<th>Browser</th>
										<th>IP Address</th>
										<th>Device</th>
										<th>SID</th>
										<th>SID2</th>
										<th>SID3</th>
										<th>SID4</th>
										<th>SID5</th>

									</thead>
									<tbody>
										<?php $sno=0?>
										@foreach($qry as $q)
										<?php $sno++;
										if(strtolower($q->browser)==strtolower('Chrome')){
												$chrome++;
										};
										if(strtolower($q->browser)==strtolower('Firefox')){
												$firefox++;
										};
										if(strtolower($q->browser)==strtolower('Opera Mini')){
												$opera++;
										};
										if(strtolower($q->browser)==strtolower('Safari')){
												$safari++;
										};
										if(strtolower($q->browser)==strtolower('Internet Expolorer')){
												$internet++;
										};
										if(strtolower($q->browser)==strtolower('Edge')){
												$edge++;
										};

										?>
										<tr>
											<td>{{$sno}}</td>
											<td>{{$q->offer_name}}</td>
											<td>{{$q->payout*$q->payout_percentage/100}}</td>
											<td>{{$q->created_at}}</td>

											<td>{{$q->country}}</td>
											<td>{{$q->browser}}</td>
											<td>{{$q->ip_address}}</td>
											<td>{{$q->ua_target}}</td>
											<td>{{$q->sid}}</td>
											<td>{{$q->sid2}}</td>
											<td>{{$q->sid3}}</td>
											<td>{{$q->sid4}}</td>
											<td>{{$q->sid5}}</td>
										 
											 
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="card radius-10">
								<div class="card-body">
									<div id="device_chart"></div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="card radius-10">
								<div class="card-body">
									<div id="browser_chart"></div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
					<div class="row">
						<div class="col-12 col-lg-8 d-lg-flex align-items-lg-stretch">
							<div class="card radius-10 w-100">
								<div class="card-header border-bottom-0">
									<div class="d-lg-flex align-items-center">
										<div class="">
											<h5 class="mb-1">Chart View</h5>
												</div>
									 	 
									</div>
								</div>
								<div class="card-body">
									<div id="website_audience_chart"></div>
								</div>
							</div>
						</div>
						<?php 

						?>
						<div class="col-12 col-lg-4 d-lg-flex align-items-lg-stretch">
							<div class="card radius-10 w-100">
								<div class="card-header">Traffic Sources</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0">
											<thead>
												<tr>
													<th>Source</th>
													<th>Visitors</th>
													<th>%</th>
												</tr>
											</thead>
											<tbody>
												@foreach($source as $s)
												<tr>
													<td>{{$s->source}}</td>
													<td>{{$s->visitors}}</td>
													<td>{{round($s->visitors*100/$rows,2)}}%</td>
												</tr>
												 @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
							   	 
					</div>

					<!--end row-->
					<div class="card-deck flex-column flex-lg-row">
						<div class="card radius-10">
							<div class="card-body">
								<div id="location_chart"></div>
							</div>
						</div>
						 
					</div>
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
		   <script src="{{asset('dashboard_assets/js/index3.js')}}" defer ></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
		   <script type="text/javascript">

		   	$(function(){

$('select[name=type]').change(function(){
	if($('select[name=type]').val()=='smartlink'){
				$('#smartlinkhide').removeClass('d-none');	

	}
	else{
$('#smartlinkhide').addClass('d-none');
('select[name=type]').val('')
	}
})
		   		var desktop=parseInt('{{isset($qry[0])?$qry[0]->desktop:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
		   			var mobile=parseInt('{{isset($qry[0])?$qry[0]->mobile:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
		   				var tablet=parseInt('{{isset($qry[0])?$qry[0]->tablet:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';

	let location=JSON.parse('<?php echo $location?>');
	 
 let l=[];
	for(var i=0;i<location.length;i++){
		l.push({name:location[i].country,y:location[i].visitors/'<?php echo $rows?>'});
	}
	// Build the chart
	 
		   		 	"use strict";
	// chart 1
	Highcharts.chart('device_chart', {
		chart: {
			height: 350,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Sessions Device'
		},
		subtitle: {
			text: 'Ratio of devices use by users'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				innerSize: 120,
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				},
				showInLegend: true
			}
		},
		//colors: ['#ff9ad5', '#50b5ff', '#5a65dc'],
		series: [{
			name: 'Users',
			colorByPoint: true,
			data: [{
				name: 'Desktop',
				y: desktop
			}, {
				name: 'Mobile',
				y: mobile
			}, {
				name: 'Tablet',
				y: tablet
			}]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					plotOptions: {
						pie: {
							innerSize: 140,
							dataLabels: {
								enabled: false
							}
						}
					},
				}
			}]
		}
	});






	var chrome=parseInt('{{isset($qry[0])?$chrome:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
 
	var internet=parseInt('{{isset($qry[0])?$internet:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
	var edge=parseInt('{{isset($qry[0])?$edge:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
	var safari=parseInt('{{isset($qry[0])?$safari:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
	var opera=parseInt('{{isset($qry[0])?$opera:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
	var firefox=parseInt('{{isset($qry[0])?$firefox:0}}')*100/'{{isset($qry[0])?$qry[0]->total_rows:1}}';
		   		 

	// chart 2
	// Create the chart
	Highcharts.chart('browser_chart', {
		chart: {
			height: 350,
			type: 'column',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Browser usage'
		},
		subtitle: {
			text: 'Records of browser usage by users'
		},
		accessibility: {
			announceNewData: {
				enabled: true
			}
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: 'Browsers usage by users'
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:.1f}%'
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		},
		//colors: ['#ff6459', '#f5964b', '#56aafb', '#62aedf', '#9a78f0', '#5bb75f'],
		series: [{
			name: "Browsers",
			colorByPoint: true,
			data: [{
				name: "Chrome",
				y: chrome,
				drilldown: "Chrome"
			}, {
				name: "Firefox",
				y: firefox,
				drilldown: "Firefox"
			}, {
				name: "Internet Explorer",
				y: internet,
				drilldown: "Internet Explorer"
			}, {
				name: "Safari",
				y: safari,
				drilldown: "Safari"
			}, {
				name: "Edge",
				y: edge,
				drilldown: "Edge"
			}, {
				name: "Opera",
				y: opera,
				drilldown: "Opera"
			}]
		}],
		drilldown: {
			series: [{
				name: "Chrome",
				id: "Chrome",
				data: [
				 
				]
			}, {
				name: "Firefox",
				id: "Firefox",
				data: [
				 
				]
			}, {
				name: "Internet Explorer",
				id: "Internet Explorer",
				data: [
					 
				]
			}, {
				name: "Safari",
				id: "Safari",
				data: [
					 
				]
			}, {
				name: "Edge",
				id: "Edge",
				data: [
				 
				]
			}, {
				name: "Opera",
				id: "Opera",
				data: [
					 
				]
			}]
		}
	});

	// Make monochrome colors
	var pieColors = (function () {
		var colors = ['#219fde', 'rgb(3 112 230 / 76%)', 'rgb(3 112 230 / 60%)', 'rgb(3 112 230 / 46%)', 'rgb(3 112 230 / 26%)'],
			base = Highcharts.getOptions().colors[0],
			i;
		for (i = 0; i < 10; i += 1) {
			// Start out with a darkened base color (negative brighten), and end
			// up with a much brighter color
			colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
		}
		return colors;
	}());


; 	Highcharts.chart('location_chart', {
		chart: {
			//height:380,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			//styledMode: true
		},
		credits: {
			enabled: false
		},
		exporting: {
			buttons: {
				contextButton: {
					enabled: false,
				}
			}
		},
		title: {
			text: 'Visitors by Location'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				innerSize: 0,
				colors: pieColors,
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
					distance: -50,
					filter: {
						property: 'percentage',
						operator: '>',
						value: 4
					}
				}
			}
		},
		series: [{
			name: 'Visitors',
			data: l
		}]
	});
let clicks=[];
let leads=[];
let date=[];
let earnings=[];
var qry=JSON.parse('<?php echo $diff_qry ?>');

for(var i=0;i<qry.length;i++){
        clicks.push(qry[i].clicks);
        leads.push(qry[i].leads);
        date.push(qry[i].created_at);
        if(qry[i].earnings==null){
         earnings.push(0);
        }else{
        earnings.push(qry[i].earnings);
}
}
// chart 3
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
        colors: ["#CCEEFF", '#80D4FF','#00e65c'],
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
    var chartLine = new ApexCharts(document.querySelector('#website_audience_chart'), optionsLine);
    chartLine.render();		 })

		   </script>
	 @endsection('content')