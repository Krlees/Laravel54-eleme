<?php

namespace App\Http\Controllers\api;

use App\Services\Admin\GoodsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    private $goods;

    public function __construct(GoodsService $goods)
    {
        $this->goods = $goods;
    }

    public function getGoods(Request $request)
    {
        return $this->goods->getGoods();
    }
}
