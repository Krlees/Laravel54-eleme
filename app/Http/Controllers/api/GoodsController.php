<?php

namespace App\Http\Controllers\api;

use App\Repositories\GoodsRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    private $goods;

    public function __construct(GoodsRepositoryEloquent $goods)
    {
        $this->goods = $goods;
    }

    public function getGoods(Request $request)
    {
        return $this->goods->getList();
    }
}
