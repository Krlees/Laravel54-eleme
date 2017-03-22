<?php
namespace App\Repositories;

use App\Models\MenuModel;
use Prettus\Repository\Eloquent\BaseRepository;

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
     * 获取子菜单
     *
     * @param $id
     * @return mixed
     */
    public function getMenuSelects($id)
    {
        return $this->model->where(['pid'=>$id])->get();
    }

    /**
     * ajax获取菜单
     *
     * @param $offset
     * @param $limit
     * @param bool $sort
     * @param $order
     * @param array $where
     * @return array
     */
    public function ajaxMenuList($offset, $limit, $sort=false, $order, $where = [])
    {
        $sort = $sort ?: $this->model->getKeyName();
        $rows = $this->model->where($where)->orderBy($sort,$order)->offset(0)->limit($limit)->get()->toArray();
        $total = $this->model->where($where)->count();

        return compact('rows', 'total');
    }


}
