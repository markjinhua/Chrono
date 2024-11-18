<?

public function searchOffers(Request $request){

    $query = Offer::query();

    if (isset($request->name))
    {
        $query->where('offer_name', 'like', '%' . $request->name . '%');
    }
    if (isset($request->id))
    {
        $query->where('id', $request->id);
    }
    if (isset($request->status))
    {
        $query->where('status', $request->status);
    }
    if (isset($request->offer_type))
    {
        $query->where('offer_type', $request->offer_type);
    }

    $offers = $query->paginate('10');

    return view('admin.view_offers', compact('offers'));
}
