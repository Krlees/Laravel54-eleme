<?php
namespace App\Repositories;
use App\Models\GoodsModel;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * 菜单仓库
 */
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

    public function getList()
    {
        $datas = $this->model->all();

        return $datas;
    }


}
