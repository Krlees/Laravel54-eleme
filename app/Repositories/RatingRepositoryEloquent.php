<?php
namespace App\Repositories;

use App\Models\MemberModel;
use App\Models\RatingModel;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * 菜单仓库
 */
class RatingRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RatingModel::class;
    }

    /**
     * 获取评论数据
     *
     * @param $id
     * @return mixed
     */
    public function getSellerRating($seller_id)
    {

        $data = $this->model->where(['seller_id' => $seller_id])->get();
        foreach ($data as $k => $v) {
            $member_info = MemberModel::where(['id' => $v['userid']])->first(['username','avatar']);

            $data[$k]['recommend'] = $v['recommend'] ? explode(",", $v['recommend']) : '';
            $data[$k]['username'] = $member_info->username ?: '';
            $data[$k]['avatar'] = $member_info->avatar ?: '';
        }

        return $data;
    }

    public function getGoodsRating($goods_id)
    {

    }


}
