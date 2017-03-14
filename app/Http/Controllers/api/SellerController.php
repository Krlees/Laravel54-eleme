<?php

namespace App\Http\Controllers\api;

use App\Repositories\SellerRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    private $seller;

    public function __construct(SellerRepositoryEloquent $seller)
    {
        $this->seller = $seller;
    }

    public function getSeller()
    {
        $this->seller->getSellerInfo(1);
    }


}
