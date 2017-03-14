<?php
namespace App\Repositories;

use App\Models\SellerCountModel;
use App\Models\SellerModel;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * 菜单仓库
 */
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
     * 查询商家信息
     *
     * @param $id  商家主键ID
     * @return array
     */
    public function getSellerInfo($id)
    {
        $seller_info = $this->model->find($id)->toArray();
        if( empty($seller_info) ){
            return [];
        }

        $seller_count = SellerCountModel::where(['seller_id'=>$id])->first()->toArray();

        return array_merge($seller_count,$seller_info);
    }


}
