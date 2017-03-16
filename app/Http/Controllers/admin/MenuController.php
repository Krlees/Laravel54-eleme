<?php

namespace App\Http\Controllers\admin;

use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    private $menu;

    public function __construct(MenuRepositoryEloquent $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
        if( $request->ajax()){
            $offset = $request->input('offset');
            $limit = $request->input('limit', 10);

            // 获取菜单列表
            $results = $this->menu->ajaxMenuList();

            return $this->reponseDataTabel($results['total'], $results['rows']);
        }
        else {

        }
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {

        } else {
            $menu_data = $this->menu->getMenuList();
            $formField = [
                returnformField('select', '上级菜单', 'pid', $menu_data),
                returnformField('text', '菜单名', 'name'),
                returnformField('text', 'Url路由', 'url'),
                returnformField('text', 'Icon', 'icon'),
            ];

            return view('admin/menu/add',$this->reponseForm('添加菜单',$formField));
        }
    }

    public function edit()
    {

    }

    public function del()
    {

    }

}
