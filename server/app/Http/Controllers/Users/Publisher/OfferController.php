<?php
namespace App\Http\Controllers\Users\Publisher;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Http\Request;
use DB;
use Auth;
class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:publisher');
    }

    public function PublicOffers()
    {
        if (Auth::guard('publisher')->user()->expert_mode == 1) {
            $offers = Offer::where('offer_type', 'public')->paginate(10);
        return view('publisher.public_offers', compact('offers'));
        }
        else{
             return redirect('/publisher');
        }
    }
     public function TopMembers()
    {
        return view('publisher.top_members');
    }

     public function PrivateOffers()
    {
        $offers = Offer::where('offer_type', 'private')->paginate(10);
         if (Auth::guard('publisher')->user()->expert_mode == 1) {
              return view('publisher.private_offers', compact('offers'));
        }
        else{
             return redirect('/publisher');
        }

    }

    public function PrivateOffers2(){
        if (Auth::guard('publisher')->user()->expert_mode == 1) {
            return view('publisher.private_offers2');
      }
      else{
           return redirect('/publisher');
      }
    }

   public function SpecialOffers()
    {
        $offers = Offer::where('offer_type', 'special')->paginate(10);
        if (Auth::guard('publisher')->user()->expert_mode == 1) {
              return view('publisher.special_offers', compact('offers'));
 }
        else{
             return redirect('/publisher');
        }

    }

   public function NewOffers()
    {
        if (Auth::guard('publisher')->user()->expert_mode == 1) {
            $offers = Offer::paginate(10);
             return view('publisher.new_offer', compact('offers'));
 }
        else{
            return redirect('/publisher');
        }

    }

   public function TopOffers()
    {
         if (Auth::guard('publisher')->user()->expert_mode == 1) {
            $offers = Offer::orderBy('clicks', 'desc')
            ->paginate(10);
             return view('publisher.top_offers', compact('offers'));
}
        else{
              return redirect('/publisher');
        }

    }


    public function offerSearch(Request $request){
        $query = Offer::query();
        $query->whereBetween('payout', [$request->from_payout, $request->to_payout]);
        $query->where('offer_type', $request->offer_type);
        if (isset($request->name))
        {
            $query->where('offer_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id))
        {
            $query->where('id', $request->id);
        }

        if (isset($request->ascending))
        {
            $query->orderBy('id', $request->ascending);
        }

        $offers = $query->paginate(10);

        if($request->offer_type == 'public'){
            // return $offers;
            return view('publisher.public_offers', compact('offers'));
        }
        if($request->offer_type == 'private'){
            // return $offers;
            return view('publisher.private_offers', compact('offers'));
        }

        if($request->offer_type == 'special'){
            // return $offers;
            return view('publisher.special_offers', compact('offers'));
        }

    }

    public function newOfferSearch(Request $request){
        $query = Offer::query();
        $query->whereBetween('payout', [$request->from_payout, $request->to_payout]);
        if (isset($request->name))
        {
            $query->where('offer_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id))
        {
            $query->where('id', $request->id);
        }

        if (isset($request->ascending))
        {
            $query->orderBy('id', $request->ascending);
        }

        $offers = $query->paginate(10);

        return view('publisher.new_offer', compact('offers'));

    }

    public function topOfferSearch(Request $request){
        $query = Offer::query();
        $query->whereBetween('payout', [$request->from_payout, $request->to_payout]);
        if (isset($request->name))
        {
            $query->where('offer_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id))
        {
            $query->where('id', $request->id);
        }

        $query->orderBy('clicks', 'desc');

        $offers = $query->paginate(10);

        return view('publisher.top_offers', compact('offers'));

    }

       public function OfferDetails($id)
    {
        return view('publisher.offer_detail',['data'=>$id]);
    }

   public function requestApproval(Request $request)
    {
        DB::table('approval_request')->insert([
        	'offer_id'=>$request->id,
        	'publisher_id'=>Auth::guard('publisher')->id(),
        	'approval_status'=>'Requested',
        	'description'=>$request->description,
        	'terms'=>$request->terms
        ]);
        return response()->json('success');
    }



     public function SearchNewOffer(Request $request)
    {
    $countries='1=1';
    $count=0;
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
    	 	$countries=' countries like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$countries.=' or countries like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	 $ua='1=1';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
    	 	$ua=' ua_target like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$ua.=' or ua_target like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
   $id=Auth::guard('publisher')->id();
if(isset($request->category)){
	$category=implode(',', $request->category);
    $qry= DB::select("SELECT o.offer_name,ap.approval_status,o.payout_percentage,o.offer_type,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where   o.status='Active' and o.offer_type!='special' and  (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)      and o.category_id in ($category) and ($countries) and  ($ua)   order by o.id $request->ascending");
}else{
	  $qry= DB::select("SELECT o.offer_name,ap.approval_status,o.payout_percentage,o.offer_type,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id  where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.offer_type!='special'  and o.status='Active'  and ($countries) and  ($ua)   order by o.id $request->ascending");

}
    return response()->json($qry);
    }


     public function SearchOffer(Request $request)
    {
        return $request;
    $countries='1=1';
    $count=0;
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
    	 	$countries=' countries like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$countries.=' or countries like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	 $ua='1=1';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
    	 	$ua=' ua_target like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$ua.=' or ua_target like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}

if(isset($request->category)){
	$category=implode(',', $request->category);
    $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o  left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1   and o.status='Active' and o.offer_type='public' and o.category_id in ($category) and ($countries) and  ($ua)   order by o.id $request->ascending");
}else{
	  $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o  left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1 and o.offer_type='public'  and o.status='Active'  and ($countries) and  ($ua)   order by o.id $request->ascending");

}
    return response()->json($qry);
    }



     public function SearchTopOffer(Request $request)
    {
    $countries='1=1';
    $count=0;
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
    	 	$countries=' countries like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$countries.=' or countries like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	 $ua='1=1';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
    	 	$ua=' ua_target like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$ua.=' or ua_target like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}

if(isset($request->category)){
	$category=implode(',', $request->category);


    $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o  left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1   and o.status='Active' and o.offer_type='public' and o.category_id in ($category) and ($countries) and  ($ua)   order by  o.clicks/o.leads*100 desc");
}else{
	  $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o  left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1 and o.offer_type='public'   and o.status='Active'  and ($countries) and  ($ua)   order by o.clicks/o.leads*100  desc");

}
    return response()->json($qry);
    }



      public function SearchSpecialOffer(Request $request)
    {
    $countries='1=1';
    $count=0;
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
    	 	$countries=' countries like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$countries.=' or countries like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	 $ua='1=1';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
    	 	$ua=' ua_target like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$ua.=' or ua_target like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}

   $id=Auth::guard('publisher')->id();
if(isset($request->category)){
	$category=implode(',', $request->category);
    $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o join offers_publisher as p on p.offer_id=o.id left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1 and  p.publisher_id='$id'  and o.status='Active' and o.offer_type='special' and o.category_id in ($category) and ($countries) and  ($ua)   order by o.id $request->ascending");
}else{
	  $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o join offers_publisher as p on p.offer_id=o.id   left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and  p.publisher_id='$id' and o.native!=1 and o.lockers!=1 and o.offer_type='special'  and o.status='Active'  and ($countries) and  ($ua)   order by o.id $request->ascending");

}
    return response()->json($qry);
    }

     public function SearchPrivateOffer(Request $request)
    {
    $countries='1=1';
    $count=0;
    if(isset($request->countries)){
    foreach ($request->countries as $c) {
if($count==0){
    	 	$countries=' countries like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$countries.=' or countries like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}
    	 $ua='1=1';
    $count=0;
    if(isset($request->ua_target)){
    foreach ($request->ua_target as $c) {
if($count==0){
    	 	$ua=' ua_target like \'%'.$c.'%\' ';
    	 }
    	 else{
    	 		$ua.=' or ua_target like \'%'.$c.'%\' ';
    	 }
    	 $count++;
    	 }
    	}

   $id=Auth::guard('publisher')->id();
if(isset($request->category)){
	$category=implode(',', $request->category);

	if($request->status==''){
    $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,ap.approval_status,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1   and o.status='Active' and o.offer_type='private' and o.category_id in ($category) and ($countries) and  ($ua)   order by o.id $request->ascending");
}
else{
	    $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,ap.approval_status,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1   and o.status='Active' and o.offer_type='private'  and ap.approval_status='$request->status' and o.category_id in ($category) and ($countries) and  ($ua)   order by o.id $request->ascending");

}
}else{
	if($request->status==''){


	  $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,ap.approval_status,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1 and o.offer_type='private'  and o.status='Active'  and ($countries) and  ($ua)   order by o.id $request->ascending");
	}
	else{
		 $qry= DB::select("SELECT o.offer_name,o.offer_type,o.payout_percentage,c.category_name,o.countries,o.payout_type,o.payout,o.ua_target,o.status,o.clicks,o.conversion,o.browsers,o.incentive_allowed,o.smartlink,o.magiclink,o.native,o.lockers,o.preview_url,ap.approval_status,o.verticals,o.id as offerid,(select GROUP_CONCAT(pub.name) from offers_publisher as of join publishers as pub on pub.id=of.publisher_id where of.offer_id=o.id) as publisher_name  FROM `offers`  as o left join approval_request as ap on ap.offer_id=o.id and ap.publisher_id='$id'   left join category as c on c.id=o.category_id where (o.offer_name like '%$request->name%') and (o.id like '%$request->id%')    and (o.payout>=$request->from_payout and o.payout<=$request->to_payout)  and o.magiclink!=1 and o.smartlink!=1 and o.native!=1 and o.lockers!=1 and o.offer_type='private'  and o.status='Active' and ap.approval_status='$request->status'  and ($countries) and  ($ua)   order by o.id $request->ascending");
	}

}
    return response()->json($qry);
    }

}
