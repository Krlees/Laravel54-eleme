<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerModel extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'seller';

    protected $primaryKey = 'id';

    protected $foreignKey = 'seller_id';

    public function belongSellerCountModel()
    {
        return $this->belongsTo(SellerCountModel::class,$this->primaryKey,$this->foreignKey);
    }


}
