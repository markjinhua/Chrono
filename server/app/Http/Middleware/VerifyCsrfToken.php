<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
       'user-dashboard/paytab_return','paypal','user-dashboard/InsertDocument','logout','publisher/upload-image','publisher/filter-smartlink','publisher/reports','admin','publisher/logout','admin/logout'
    ];
}
