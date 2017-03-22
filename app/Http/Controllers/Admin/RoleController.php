<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    private $role;

    public function __construct(RoleService $role)
    {
        $this->role = $role;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            // 过滤参数
            $data = $this->cleanAjaxPageParam($request->all());
            $results = $this->role->ajaxRoleList($data);

            return $this->responseAjaxTable($results['total'], $results['rows']);
        } else {

            $action = $this->returnActionFormat(url('admin/role/add'), url('admin/role/edit'), url('admin/role/del'));
            $reponse = $this->returnSearchFormat(url('admin/role/index'), null, $action);

            return view('admin/role/index', compact('reponse'));
        }
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->input('data');

            $b = $this->role->createData($data);
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {

            $this->returnFieldFormat('text', '标识', 'data[name]');
            $this->returnFieldFormat('text', '角色名称', 'data[display_name]');
            $this->returnFieldFormat('textarea', '描述', 'data[description]');

            $reponse = $this->returnFormFormat('添加角色', $this->formField);
            return view('admin/role/add', compact('reponse'));
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->input('data');

            $b = $this->role->updateData($id, $data);
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {
            $info = $this->role->findById($id);

            $this->returnFieldFormat('text', '标识', 'data[name]',$info->name);
            $this->returnFieldFormat('text', '角色名称', 'data[display_name]',$info->display_name);
            $this->returnFieldFormat('textarea', '描述', 'data[description]', $info->description);

            $reponse = $this->returnFormFormat('编辑角色', $this->formField);
            return view('admin/role/add', compact('reponse'));
        }

    }

    public function del(Request $request)
    {

    }
}
