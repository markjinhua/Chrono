<?php
namespace App\Http\Controllers\Users\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:publisher');
    }

    public function OfferApi()
    {
        return view('publisher.offer_api');
    }
}