<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 模型的日期字段保存格式。
     *
     * @var string
     */
    // protected $dateFormat = 'U';

    /**
     * 此模型的连接名称。
     *
     * @var string
     */
    // protected $connection = 'connection-name';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
     protected $fillable = [
         'name','description','info','price','oldPrice','storage','flag','status'
     ];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    // protected $guarded = ['price'];

    protected $primaryKey = 'id';

    protected $foreignKey = 'goods_id';


    public function category(){
        return $this->belongsToMany('App\Models\GoodsClassModel','goods_class_connect',$this->foreignKey,'class_id');
    }

}
