<?php
namespace App\Http\Controllers\Users\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth:publisher','2fa']);
    }

    public function PaymentHistory()
    {
        return view('publisher.payment_history');
    }

}