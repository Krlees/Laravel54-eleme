<?php
namespace App\Repositories;

use App\Models\GoodsClassModel;
use App\Models\GoodsModel;
use App\Models\RatingModel;
use Prettus\Repository\Eloquent\BaseRepository;

class GoodsClassRepositoryEloquent extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GoodsClassModel::class;
    }

    /**
     * 返回所有分类
     */
    public function getAllClass()
    {
        $datas = $this->model->where('pid',0)->get();
        foreach ($datas as $key=>$val){
            $val->sub = $this->model->where('pid',$val->id)->get()->toArray();
        }

        return $datas;
    }

    public function getSubClass($id)
    {
        return $this->model->where('pid',$id)->get();
    }




}
