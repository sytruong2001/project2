<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function _construct()
    {
        $this->LoginCheck();
    }

    function LoginCheck()
    {
        if(Auth::guard('users')->check()){
            view()->share('user', Auth::user());
        }
        
    }
}
