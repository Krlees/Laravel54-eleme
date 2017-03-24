<?php

namespace App\Http\Controllers\api;

use App\Services\Api\RatingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    private $rating;

    public function __construct(RatingService $rating)
    {
        $this->rating = $rating;
    }

    public function getSellerRating()
    {
        return $this->rating->getSellerRating(1);
    }


}
