<?php
namespace App\Services\Admin;

use App\Repositories\GoodsClassRepositoryEloquent;
use App\Repositories\GoodsRepositoryEloquent;
use App\Services\Admin\BaseService;
use Exception, DB;

class GoodsService extends BaseService
{
    private $goods;
    private $goodsClss;

    public function __construct(GoodsRepositoryEloquent $goods,GoodsClassRepositoryEloquent $goodsClss)
    {
        $this->goods = $goods;
        $this->goodsClass = $goodsClss;
    }

    public function getTopGoods()
    {
        return $this->goods->getTopGoods();
    }

    public function getAllGoods()
    {
        return $this->goods->getAllGoods();
    }

    public function ajaxGoodsList($param)
    {
        $where = [['pid', 0]];
        if (isset($param['search'])) {
            $where = [
                ['pid', 0],
                ['name', 'like', "%{$param['search']}%", 'and'],
            ];
        }

        return $this->goods->ajaxGoodsList($param['offset'], $param['limit'], $param['sort'], $param['order'], $where);
    }

    /**
     * 根据菜单ID查找数据
     * @author 晚黎
     * @date   2016-11-04T16:25:59+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function findGoodsById($id)
    {
        $goods = $this->goods->with('category')->find($id)->toArray();

        return $goods;
    }

    /**
     * 获取菜单 <select>
     */
    public function getAllClassSelects()
    {
        return $this->goodsClass->getAllClass()->toArray();
    }

    public function getSubClass($id)
    {
        return $this->goodsClass->getSubClass($id);
    }

    /**
     * 创建数据
     */
    public function createData($param)
    {
        $data = $param['data'];
        $results = $this->goods->create($data)->category()->sync($param['ids']);

        return $results ?: false;
    }

    public function updateData($param, $id)
    {
        $data = $param['data'];
        $data['flag'] = implode($data['flag'],",");

        $results = $this->goods->update($data,$id)->category()->sync($param['ids']);;

        return $results ?: false;
    }

    public function delData($ids)
    {
        if( empty($ids) ){
            return false;
        }

        $goodsModel = $this->goods->model();
        $m = $goodsModel::whereIn('id',$ids);
        $results = $m->delete();
        DB::table('goods_class_connect')->whereIn('goods_id',$ids)->delete();

        return $results;

    }


}