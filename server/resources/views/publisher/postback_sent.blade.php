
@extends('publisher.publisher_layouts.header')
@extends('publisher.publisher_layouts.sidebar')
@extends('publisher.publisher_layouts.footer')
@section('content')

 
 
    
      </style>
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 ">
                             <div class="card">
                                    <div class="card-header">
                                      <h3>Postback Sent
                                    </div>
                                    <div class="card-body ">
  <?php

             $qry=DB::table('postback_sent')->where('publisher_id',Auth::guard('publisher')->id())->orderBy('id','desc')->get();

             ?>
<div class="table-responsive">
      <table id="example2" class="table table-striped table-bordered " style="width:100%">
                  <thead>
                    <tr>
                  <th >ID</th>
                <th>DATE</th>
                <th>PAYOUT</th>
               
                <th>OFFER ID</th>
               

                <th>STATUS</th>
 <th >QUERY</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($qry as $q)
                <tr>
                <td>{{$q->id}}</td>
                  <td>{{$q->created_at}}</td>
                  <td>${{round($q->payout,2)}}</td>
                  <td>{{$q->offer_id}}</td>
                 
                    <td>{{$q->status}}</td>
                     <td>{{$q->url}}</td>
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
                  </div>

                  @endsection('content')