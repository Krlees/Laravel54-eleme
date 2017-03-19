<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(MenuRepositoryEloquent $menu)
    {

        $menus = $menu->getAllMenu();

        return view('admin/index', compact('menus'));
    }


}
