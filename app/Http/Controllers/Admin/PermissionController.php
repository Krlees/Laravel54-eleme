<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Admin\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    private $perm;

    public function __construct(PermissionService $perm)
    {
        $this->perm = $perm;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            // 过滤参数
            $data = $this->cleanAjaxPageParam($request->all());
            $results = $this->perm->ajaxPermList($data);

            return $this->responseAjaxTable($results['total'],$results['rows']);
        }
        else {
            $action = $this->returnActionFormat(url('admin/permission/add'),url('admin/permission/edit'),url('admin/menu/del'));
            $reponse = $this->returnSearchFormat(url('admin/permission/index'),null,$action);

            return view('admin/permission/index', compact('reponse'));
        }
    }

    public function add(Request $request)
    {
        if( $request->ajax() ){

        }
        else {
            $permSelects = $this->perm->getPermSelects();
            $this->returnFieldFormat('select', '上级菜单', 'data[pid]', $this->returnSelectFormat($permSelects, 'name', 'id'));
            $this->returnFieldFormat('text','路由名','name');
            $reponse = $this->returnFormFormat('添加权限',$this->formField);

            return view('admin/permission/add', compact('reponse'));

        }
    }

    public function edit()
    {

    }

    public function del()
    {

    }

}
