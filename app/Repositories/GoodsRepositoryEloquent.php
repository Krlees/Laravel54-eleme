<?php
namespace App\Repositories;

use App\Models\GoodsClassModel;
use App\Models\GoodsModel;
use App\Models\RatingModel;
use Prettus\Repository\Eloquent\BaseRepository;

class GoodsRepositoryEloquent extends BaseRepository
{

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

        $datas = $this->model_class->with('model')->where($where)->get()->toArray();
        foreach ($datas as $k => $v) {
            $datas[$k]['foods'] = $v['model'];

            foreach ($v['model'] as $model) {
                $rating = $this->rating->where(['model_id' => $model['id']])->get()->toArray();
                foreach ($rating as $key => $v) {
                    $member_info = \DB::table('member')->find($v['userid']);
                    $rating[$key]['username'] = $member_info->username ?: '';
                    $rating[$key]['avatar'] = $member_info->avatar ?: '';
                }
                $data['rating'] = $rating;
            }

            $datas[$k]['foods']['rating'] = $rating ?: [];

            unset($datas[$k]['model']);
        }

        return $datas;
    }

    /**
     * 返回所有分类
     */
    public function getGoodsClass()
    {
        return $this->model_class->get();
    }

    /**
     * ajax获取商品列表
     *
     * @param $start
     * @param $limit
     * @return array
     */
    public function ajaxGoodsList($start,$limit)
    {
//        $rows = $this->model->with('category')->offset($start)->limit($limit)->get()->toArray();
        $rows = $this->model->offset($start)->limit($limit)->get()->toArray();
        $total = $this->model->count();

        return compact('rows','total');
    }

    /**
     * 顶级分类
     */
    public function getTopGoods()
    {
        return $this->model->where('pid',0)->get();
    }

    /**
     * 子分类
     */
    public function getSubGoods($id)
    {
        return $this->model->get();
    }

    public function delGoods()
    {
    }

}
