<?php
namespace App\Repositories;

use App\Models\GoodsClassModel;
use App\Models\GoodsModel;
use App\Models\RatingModel;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * 菜单仓库
 */
class GoodsRepositoryEloquent extends BaseRepository
{
    private $goods;
    private $goods_class;
    private $rating;

    public function __construct(GoodsModel $goods, GoodsClassModel $goods_class, RatingModel $rating)
    {
        $this->goods = $goods;
        $this->goods_class = $goods_class;
        $this->rating = $rating;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GoodsModel::class;
    }

    /**
     * 返回所有分类下的商品
     *
     * @param $id  分类ID
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList($id = null)
    {
        $where = [];
        if (!is_null($id)) {
            $where['id'] = $id;
        }

        $datas = $this->goods_class->with('goods')->where($where)->get()->toArray();
        foreach ($datas as $k => $v) {
            $datas[$k]['foods'] = $v['goods'];

            foreach ($v['goods'] as $goods) {
                $rating = $this->rating->where(['goods_id' => $goods['id']])->get()->toArray();
                foreach ($rating as $key => $v) {
                    $member_info = \DB::table('member')->find($v['userid']);
                    $rating[$key]['username'] = $member_info->username ?: '';
                    $rating[$key]['avatar'] = $member_info->avatar ?: '';
                }
                $data['rating'] = $rating;
            }

            $datas[$k]['foods']['rating'] = $rating ?: [];

            unset($datas[$k]['goods']);
        }

        return $datas;
    }


}
