<?php

namespace App\Http\Controllers\api;

use App\Repositories\RatingRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    private $rating;

    public function __construct(RatingRepositoryEloquent $rating)
    {
        $this->rating = $rating;
    }

    public function getSellerRating()
    {
        return $this->rating->getSellerRating(1);
    }


}
