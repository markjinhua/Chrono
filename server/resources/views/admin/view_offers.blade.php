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
                            		<h4>View Offers</h4>
  </div>
  <div class="card-body">

    			<form action="{{url('admin/search/offer')}}" method="get">
                    @csrf
    		<div class="row">

    			<div class="col-lg-12 text-right">
    				<a href="{{url('admin/add-offer')}}" class="btn btn-outline-primary mt-2">Add Offer</a>
    			</div>

    			<div class="col-lg-3">
    				<label class="form-label">Countries</label>

	<select class="js-example-basic-multiple" name="countries[]" multiple="multiple" style="width: 100%" >
 <option></option>
 <?php
 $qry=DB::table('countries')->get();
foreach($qry as $q){
			?>
  			<option value="{{$q->country_name}}" >{{$q->country_name}}</option>
		<?php }
?>
</select>
    			</div>
    			<div class="col-lg-3">
    				<label class="form-label">Name</label>
    				<input type="" name="name" class="form-control"  placeholder="Enter Name Keyword" id="name">
    			</div>
    			<div class="col-lg-2">
    				<label class="form-label">Id</label>
    				<input type="" name="id" class="form-control"  placeholder="Enter Offer Id" id="id">
    			</div>

    				<div class="col-lg-2">
    				<label class="form-label">Targeting</label>

	<select class="selectpicker" name="ua_target[]" id="ua_target" multiple data-actions-box="true"  >

				 <option value="Windows"  >Windows</option>
 <option value="Android" >Android</option>
 <option value="Iphone"  >Iphone</option>
 <option value="Ipad" >Ipad</option>
 <option value="Mac"  >Mac</option>

 </select>	</div>
 <div class="col-lg-3">
		<label class="form-label">Status</label>
		<select type="text" name="status" id="status"  class="form-control">
			<option value="">Select Status</option>
			<option value="Inactive"   >Inactive</option>
			<option value="Active"   >Active</option>
		</select>
	</div>

		<div class="col-lg-3">
					<label>Traffic</label>
	 <select type="text" name="traffic[]" id="traffic"  class="selectpicker"  multiple data-actions-box="true">

			<option value="incentive_allowed"   >Incentive</option>
			<option value="smartlink"   >Smartlink</option>
			<option value="magiclink"   >Magiclink</option>
			<option value="native"   >Native</option>
			<option value="lockers"   >Lockers</option>
		</select>
	 </div>
	 	<div class="col-lg-2">
					<label>Offer Type</label>
	 <select type="text" name="offer_type" id="offer_type"  class="form-control">
			<option value="">Select Type</option>
			<option value="Public"   >Public</option>
			<option value="Private"   >Private</option>
			<option value="Special"   >Special</option>

		</select>
	 </div>

		<div class="col-lg-2 " style="margin-top: 33px">

		<button type="submit" class="btn btn-primary">Search</button>
	</div>

 </div>
 </form>
 <div class="row">
    			<div class="col-lg-12 mt-3  table-responsive">

    				<table class="table table-sm ">
    					<thead class="thead thead-light">
    					<tr>
    						<th>Id</th>
    						<th>Name</th>
    						<th>Category</th>
    						<th>Country</th>
    						<th>Payout Type</th>
    						<th>Payout</th>
                            <th>Percent</th>
    						<th>Device</th>

    						<th>Status</th>
    						<th>Offer Type</th>
    						<th>Clicks</th>
    						<th>Conversion</th>
    						<th>Incentive</th>
    							<th>Smartlink</th>
    							<th>MagicLink</th>
    							<th>Native</th>
    							<th>Lockers</th>
    							<th>Publishers</th>
							<th>Action</th>
    					</tr>
    				</thead>
    				<tbody class="text-dark">
                        @foreach ($offers as $offer)
                        <tr>
                            <td>{{$offer->id}}</td>

                            <td>{{$offer->offer_name}}</td>

                            @php
                                $publisher = DB::table('publishers')->where('id', $offer->publisher_id)
                                ->first();
                                $advertiser = DB::table('advertisers')->where('id', $offer->advertiser_id)
                                ->first();
                                $category = DB::table('category')->where('id', $offer->category_id)
                                ->first();
                            @endphp

                            @if (isset($category))
                            <td>{{$category->category_name}}</td>
                            @else
                            <td>Null</td>
                            @endif

                            <td>{{$offer->countries}}</td>
                            <td>{{$offer->payout_type}}</td>
                            <td>{{round($offer->payout,3)}}</td>
                            <td>{{round($offer->payout_percentage,3)}}</td>
                            <td>{{$offer->browsers}}</td>
                            <td>{{$offer->status}}</td>
                            <td>{{$offer->offer_type}}</td>

                            <td>{{$offer->clicks}}</td>
                            <td>{{$offer->conversion}}</td>
                            <td>{{$offer->incentive_allowed}}</td>
                            <td>{{$offer->smartlink}}</td>
                            <td>{{$offer->magiclink}}</td>
                            <td>{{$offer->native}}</td>
                            <td>{{$offer->lockers}}</td>
                            <td>{{$offer->publishers}}</td>


                            <td>
                                <a href="{{url('admin/edit-offer', $offer->id)}}" class="text-success">Edit </a>
                                    |
                                <a href="{{url('admin/offer-delete', $offer->id)}}" class="text-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

    				</tbody>
    				</table>


                    {{$offers->appends(Request::all())->links()}}
    			</div>
    		</div>
    	</div>
    </div>
</div>
</div>
</div>
</div>

@endsection('content')
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
