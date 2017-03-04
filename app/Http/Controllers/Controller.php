<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 统一回调
     */
    public function reponseData( $code = 0,$msg = "",$data = [] )
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ]);
    }
}
