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
     * 统一API回调
     *
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function reponseData( $code = 0,$msg = "",$data = [] )
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ]);
    }

    /**
     * 表单字段统一回调
     *
     * @param $formTitle  表单标题,如:添加产品
     * @param $formField  表单字段数据
     * @param $formUrl    表单提交地址
     */
    public function reponseForm($formTitle='', $formField=[], $formUrl=null)
    {
        return compact('formTitle','formField','formUrl');
    }


}
