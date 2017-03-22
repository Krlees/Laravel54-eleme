<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Repositories\MenuRepositoryEloquent;
use App\Services\Admin\MenuService;
use App\Traits\Admin\FormTraits;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use FormTraits;

    private $menu;

    public function __construct(MenuService $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            // 过滤参数
            $param = $this->cleanAjaxPageParam($request->all());
            $results = $this->menu->ajaxMenuList($param);

            return $this->responseAjaxTable($results['total'], $results['rows']);

        } else {
            $reponse = $this->returnSearchFormat(url('admin/menu/index'), false, [
                'addUrl' => url('admin/menu/add'),
                'editUrl' => url('admin/menu/edit'),
                'removeUrl' => url('admin/menu/del'),
                'autoSearch' => true
            ]);

            return view('admin/Menu/index', compact('reponse'));
        }
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->input('data');

            $b = $this->menu->createData($data);
            return $b ? $this->responseData(0) : $this->responseData(400);

        } else {
            $menu_data = $this->menu->getTopMenu();

            $this->returnFieldFormat('select', '上级菜单', 'data[pid]', $this->returnSelectFormat($menu_data, 'name', 'id'));
            $this->returnFieldFormat('text', '名称', 'data[name]');
            $this->returnFieldFormat('text', 'Url路由', 'data[url]');
            $this->returnFieldFormat('text', '权限名', 'data[permission_name]');
            $this->returnFieldFormat('text', 'Icon', 'data[icon]');
            $this->returnFieldFormat('text', '排序', 'data[sort]');

            $reponse = $this->returnFormFormat('添加菜单', $this->formField);
            return view('admin/menu/add', compact('reponse'));
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->input('data');
            $menuModel = $this->menu->model();

            $affected = $menuModel::where(['id' => $id])->update($data);
            return $affected ? $this->responseData(0) : $this->responseData(400);

        } else {
            $data = $this->menu->findMenuById($id);

            // 菜单顶级分类
            $topMenuData = $this->menu->getTopMenu();
            $selectData = $this->returnSelectFormat($topMenuData, 'name', 'id', $data['pid']);

            $this->returnFieldFormat('select', '上级菜单', 'data[pid]', $selectData);
            $this->returnFieldFormat('text', '名称', 'data[name]', $data['name']);
            $this->returnFieldFormat('text', 'Url路由', 'data[url]', $data['url']);
            $this->returnFieldFormat('text', '权限名', 'data[permission_name]', $data['permission_name']);
            $this->returnFieldFormat('text', 'Icon', 'data[icon]', $data['icon']);
            $this->returnFieldFormat('text', '排序', 'data[sort]', $data['icon']);

            $reponse = $this->returnFormFormat('编辑菜单', $this->formField, url('admin/menu/edit/'.$id));
            return view('admin/menu/edit', compact('reponse'));
        }
    }

    public function del()
    {

    }

    /**
     * 获取子菜单
     *
     * @param $id
     */
    public function getSubMenu($id)
    {
        $data = $this->menu->getMenuSelects($id);
        return $data ? $this->responseData(0, "操作成功", $data) : $this->responseData(200, "操作失败");
    }


}
