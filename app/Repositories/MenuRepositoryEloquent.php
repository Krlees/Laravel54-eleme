<?php
namespace App\Repositories;

use App\Models\MenuModel;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * 菜单仓库
 */
class MenuRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MenuModel::class;
    }

    /**
     * 返回所有顶级菜单分类
     *
     * @return Array
     */
    public function getTopMenu()
    {
        return $this->model->where(['pid' => 0])->get()->toArray();
    }

    /**
     * 获取所有菜单分类
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllMenu()
    {
        $menus = $this->model->where(['pid' => 0])->orderBy('sort','desc')->get();
        foreach ($menus as $k => $v) {
            $v->sub = $this->model->where(['pid' => $v['id']])->get();
        }

        return $menus;
    }

    /**
     * ajax获取菜单
     *
     * @param $start
     * @param $limit
     * @param array $where
     * @return array
     */
    public function ajaxMenuList($start, $limit, $where = [])
    {
        $rows = $this->model->where($where)->offset(0)->limit($limit)->get()->toArray();
        $total = $this->model->count();

        return compact('rows', 'total');
    }


}
