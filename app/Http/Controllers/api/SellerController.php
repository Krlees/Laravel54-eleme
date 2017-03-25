<?php

namespace App\Http\Controllers\api;

use App\Services\Api\SellerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    private $seller;

    public function __construct(SellerService $seller)
    {
        $this->seller = $seller;
    }

    public function getSeller()
    {
        $data =  $this->seller->getSeller(1);
        return $this->responseApi(0,$data);
    }


}
