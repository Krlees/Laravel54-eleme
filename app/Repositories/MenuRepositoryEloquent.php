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
    public function getMenuList()
    {
        return $this->model->where(['pid'=>0])->get()->toArray();
    }

    /**
     * ajax获取菜单
     *
     * @param $start
     * @param $limit
     * @param array $where
     * @return array
     */
    public function ajaxMenuList($start,$limit,$where=[]){
        $return =$this->model->where($where)->offset(0)->limit($limit)->get()->toArray();
        return $return;
    }


}
