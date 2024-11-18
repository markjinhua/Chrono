<?php

namespace App\Http\Controllers\Users\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class ClickController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin','2faadmin']);
    }



       public function ManageClicks()
    {
        return view('admin.Manage_Clicks');
    }

}