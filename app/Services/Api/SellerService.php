<?php
namespace App\Services\Api;

use App\Repositories\SellerRepositoryEloquent;
use App\Services\Api\BaseService;

class SellerService extends BaseService
{
    private $seller;

    public function __construct(SellerRepositoryEloquent $seller)
    {
        $this->seller = $seller;
    }

    /**
     * 返回前端需要的API数据
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSeller($id)
    {
        return $this->seller->getSeller($id);
    }

    /**
     * 获取某个商家的信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $data =  $this->seller->find($id)->toArray();
        $data['count'] = $this->seller->findSellerCount()->toArray();

        return $data;
    }
}