<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Presenters\Admin\UserPresenter;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    private $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            // 过滤参数
            $data = $this->cleanAjaxPageParam($request->all());
            $results = $this->user->ajaxUserList($data);

            return $this->responseAjaxTable($results['total'], $results['rows']);
        } else {

            $action = $this->returnActionFormat(url('admin/user/add'), url('admin/user/edit'), url('admin/user/del'));
            $reponse = $this->returnSearchFormat(url('admin/user/index'), null, $action);

            return view('admin/user/index', compact('reponse'));
        }
    }

    public function add(Request $request, UserPresenter $presenter)
    {
        if ($request->ajax()) {

            $b = $this->user->createData($request->all());
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {

            $this->returnFieldFormat('text', '名称', 'data[name]');
            $this->returnFieldFormat('text', '密码', 'data[password]');
            $this->returnFieldFormat('email', 'email', 'data[email]');

            $roles = $this->user->getAllRoles();
            $extendField = $presenter->roleList($roles);

            $reponse = $this->returnFormFormat('新建用户', $this->formField);
            $reponse['extendField'] = $extendField;

            return view('admin/user/add', compact('reponse'));
        }
    }

    public function edit(Request $request, UserPresenter $presenter, $id)
    {
        if ($request->ajax()) {

            $b = $this->user->updateData($id, $request->all());
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {
            $info = $this->user->findById($id);
            $activeRoles = $this->user->getActiveRoles($id);

            $this->returnFieldFormat('text', '名称', 'data[name]',$info->name);
            $this->returnFieldFormat('text', '密码', 'data[password]','',['placeholder'=>'不修改密码请留空']);
            $this->returnFieldFormat('text', 'email', 'data[email]',$info->email);

            $roles = $this->user->getAllRoles();
            $extendField = $presenter->roleList($roles,$activeRoles);

            $reponse = $this->returnFormFormat('编辑用户', $this->formField);
            $reponse['extendField'] = $extendField;

            return view('admin/user/edit', compact('reponse'));
        }
    }

    public function del(Request $request)
    {
        $ids = $request->input('ids');
        if( !is_array($ids) ){
            $ids = explode(",",$ids);
        }

        $results = $this->user->delData($ids);
        return $results ? $this->responseData(0,"操作成功",$results) : $this->responseData(200,"操作失败");
    }
}
