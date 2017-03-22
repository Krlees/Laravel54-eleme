<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;

class RolesController extends BaseController
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
            $results = $this->role->ajaxroleList($data);

            return $this->responseAjaxTable($results['total'], $results['rows']);
        } else {

            $action = $this->returnActionFormat(url('admin/roleission/add'), url('admin/roleission/edit'), url('admin/roleission/del'));
            $reponse = $this->returnSearchFormat(url('admin/roleission/index'), null, $action);

            return view('admin/roleission/index', compact('reponse'));
        }
    }

    public function add(Request $request)
    {

    }

    public function edit(Request $request)
    {

    }

    public function del(Request $request)
    {

    }
}
