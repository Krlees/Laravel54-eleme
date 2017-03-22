<?php
namespace App\Repositories;

use App\Models\SellerCountModel;
use App\Models\SellerModel;
use Prettus\Repository\Eloquent\BaseRepository;

class SellerRepositoryEloquent extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SellerModel::class;
    }

    /**
     * 获取商家的统计数
     *
     * @param $id
     * @return mixed
     */
    public function findSellerCount($id)
    {
        return SellerCountModel::find($id);
    }

}
