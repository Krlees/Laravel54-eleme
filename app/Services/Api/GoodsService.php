<?php
namespace App\Services\Api;

use App\Repositories\GoodsRepositoryEloquent;
use App\Services\Api\BaseService;

class GoodsService extends BaseService
{
    private $goods;

    public function __construct(GoodsRepositoryEloquent $goods)
    {
        $this->goods = $goods;
    }

    /**
     * 返回前端需要的API数据
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getGoods()
    {
        return $this->goods->apiGoods();
    }
}