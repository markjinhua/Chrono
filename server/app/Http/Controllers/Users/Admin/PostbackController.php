<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class PostbackController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth:admin','2faadmin']);
    }



       public function ManagePostback()
    {
        return view('admin.Manage_Postback');
    }

       public function ManagePostbackLog()
    {
        return view('admin.Postback_log');
    }
       public function ManagePostbackLogRecieve()
    {
        return view('admin.Postback_log_Receive');
    }
}
?>