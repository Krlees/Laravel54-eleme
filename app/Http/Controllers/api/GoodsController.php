<?php

namespace App\Http\Controllers\api;

use App\Services\Api\GoodsService;
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
        $data = $this->goods->getGoods();

        return $this->responseApi(0,$data);
    }
}
