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
    public function reponseData($code = 0, $msg = "", $data = [])
    {
        return response()->json([
            'code' => $code,
            'msg' => $msg,
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
    public function reponseForm($formTitle = '', $formField = [], $formUrl = null)
    {
        return compact('formTitle', 'formField', 'formUrl');
    }

    /**
     * 表格数据回调
     *
     * @param $searchUrl
     * @param array $searchField
     * @return array
     */
    public function reponseTable($searchUrl = '', $searchField = [], $action = [])
    {
        $isForm = $searchField ? true : false;

        $action['add'] = isset($action['addUrl']) ? true : false;
        $action['remove'] = isset($action['removeUrl']) ? true : false;
        $action['autoSearch'] = isset($action['autoSearch']) ? true : false;

        return compact('searchUrl', 'searchField', 'isForm', 'action');
    }

    /**
     * 返回bootstrap-table需要的数据格式
     *
     * @param $data
     */
    public function reponseDataTabel($total,$rows)
    {
        return compact('total','rows');
    }


}
//                returnformField('email', '性别', 'sex', '', ['required']),
//                returnformField('text', '手机号码', 'phone', '', [
//                    'data-mask="99-999999999"',
//                    'aria-required="true"',
//                    'aria-invalid="true"',
//                    'datatype' => '*'
//                ], '13-799999999'),
//                returnformField('text', '密码', 'password','',['datatype'=>'*']),