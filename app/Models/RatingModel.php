<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'ratings';

    protected $primaryKey = 'id';

    public function member()
    {
        return $this->hasMany(MemberModel::class,'id','id');
    }

}
