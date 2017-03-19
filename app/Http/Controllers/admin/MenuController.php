<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Repositories\MenuRepositoryEloquent;
use App\Traits\Admin\FormTraits;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    use FormTraits;

    private $menu;

    public function __construct(MenuRepositoryEloquent $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $offset = $request->input('offset');
            $limit = $request->input('limit', 10);

            // 获取菜单列表
            $results = $this->menu->ajaxMenuList($offset, $limit);

            return $this->reponseAjaxTable($results['total'], $results['rows']);
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
            $menuModel = $this->menu->model();

            $b = $menuModel::where([])->create($data);
            return $b ? $this->reponseData(0) : $this->reponseData(400);

        } else {
            $menu_data = $this->menu->getTopMenu();

            $this->returnFieldFormat('select', '上级菜单', 'data[pid]', $this->returnSelectFormat($menu_data, 'name', 'id'));
            $this->returnFieldFormat('text', '菜单名', 'data[name]');
            $this->returnFieldFormat('text', 'Url路由', 'data[url]');
            $this->returnFieldFormat('text', 'Icon', 'data[icon]');

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
            return $affected ? $this->reponseData(0) : $this->reponseData(400);

        } else {

            $topMenuData = $this->menu->getTopMenu();
            $menuModel = $this->menu->model();
            $data = $menuModel::find($id)->toArray();

            // 菜单顶级分类
            $selectData = $this->returnCleanSelect($topMenuData, 'name', 'id', $data['pid']);

            $formField = [
                $this->returnFieldFormat('select', '上级菜单', 'data[pid]', $selectData),
                $this->returnFieldFormat('text', '菜单名', 'data[name]', $data['name']),
                $this->returnFieldFormat('text', 'Url路由', 'data[url]', $data['url']),
                $this->returnFieldFormat('text', 'Icon', 'data[icon]', $data['icon']),
            ];

            $reponse = $this->returnFormFormat('编辑菜单', $formField, url('admin/menu/edit', ['id' => $id]));
            return view('admin/menu/edit', compact('reponse'));
        }
    }

    public function del()
    {

    }


}
