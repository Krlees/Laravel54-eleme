<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Presenters\Admin\RolePresenter;
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

    public function add(Request $request, RolePresenter $presenter)
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

            $perms = $this->role->getGroupPermission(); // 获取所有权限数据
            $reponse['extendField'] = $presenter->permissionList($perms['admin']); //生成权限组视图

            return view('admin/role/add', compact('reponse', 'permissions'));
        }
    }

    public function edit($id, Request $request, RolePresenter $presenter)
    {
        if ($request->ajax()) {
            $data = $request->input('data');

            $b = $this->role->updateData($id, $data);
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {
            $info = $this->role->findById($id);
            $activePerms = $this->role->findByPerms(1);
            $activePerms = array_column($activePerms, 'id'); //角色已有的权限
            $perms = $this->role->getGroupPermission(); // 获取所有权限数据

            $this->returnFieldFormat('text', '标识', 'data[name]', $info->name);
            $this->returnFieldFormat('text', '角色名称', 'data[display_name]', $info->display_name);
            $this->returnFieldFormat('textarea', '描述', 'data[description]', $info->description);

            $reponse = $this->returnFormFormat('编辑角色', $this->formField);
            $reponse['extendField'] = $presenter->permissionList($perms['admin'], $activePerms); //生成权限组视图

            return view('admin/role/add', compact('reponse'));
        }

    }

    public function del(Request $request)
    {

    }
}
