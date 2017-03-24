<?php
namespace App\Services\Admin;

use App\Repositories\GoodsRepositoryEloquent;
use App\Services\Admin\BaseService;
use Exception, DB;

class GoodsService extends BaseService
{
    private $goods;

    public function __construct(GoodsRepositoryEloquent $goods)
    {
        $this->goods = $goods;
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
        $goods = $this->goods->find($id);
        if ($goods){
            return $goods;
        }
        // TODO替换正查找不到数据错误页面
        abort(404);
    }

    /**
     * 获取菜单 <select>
     */
    public function getGoodsSelects($id=0)
    {
        return $this->goods->getGoodsSelects($id)->toArray();
    }

    /**
     * 创建数据
     */
    public function createData($data)
    {
        $goodsModel = $this->goods->model();
        $b = $goodsModel::create($data);

        return $b ?: false;
    }

    public function updateData($data, $id){

        $b = $this->goods->update($data,$id);

        return $b ?: false;
    }


}