<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        if ($this->request->ajax()) {

        }
        else {
            $action = $this->returnActionFormat(url('admin/menu/add'),url('admin/menu/edit'),url('admin/menu/del'));
            $reponse = $this->returnSearchFormat(url('admin/permission/index'),null,$action);

            return view('admin/permission/index', compact('reponse'));
        }
    }

    public function add()
    {

    }

    public function edit()
    {

    }

    public function del()
    {

    }

}
