<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
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

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->input('data');

            $b = $this->user->createData($data);
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {

            $this->returnFieldFormat('text', '名称', 'data[name]');
            $this->returnFieldFormat('text', '密码', 'data[password]');
            $this->returnFieldFormat('email', 'email', 'data[email]');

            $reponse = $this->returnFormFormat('新建用户', $this->formField);
            return view('admin/user/add', compact('reponse'));
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->input('data');

            $b = $this->user->updateData($id, $data);
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {
            $info = $this->user->findById($id);

            $this->returnFieldFormat('text', '名称', 'data[name]',$info->name);
            $this->returnFieldFormat('text', '密码', 'data[password]','',['placeholder'=>'不修改密码请留空']);
            $this->returnFieldFormat('text', 'email', 'data[email]',$info->email);

            $reponse = $this->returnFormFormat('编辑用户', $this->formField);
            return view('admin/user/edit', compact('reponse'));
        }
    }

    public function del(Request $request)
    {

    }
}
