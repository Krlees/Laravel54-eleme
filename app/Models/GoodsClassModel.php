<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsClassModel extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods_class';

    protected $primaryKey = 'id';

    protected $foreignKey = 'class_id';

    public function goods(){
        return $this->belongsToMany('App\Models\GoodsModel','goods_class_connect',$this->foreignKey,'goods_id');
    }

}
