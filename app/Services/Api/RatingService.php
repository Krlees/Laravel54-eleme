<?php
namespace App\Services\Api;

use App\Repositories\RatingRepositoryEloquent;
use App\Services\Api\BaseService;

class RatingService extends BaseService
{
    private $rating;

    public function __construct(RatingRepositoryEloquent $rating)
    {
        $this->rating = $rating;
    }

    /**
     * 返回前端需要的API数据
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSellerRating($id)
    {
        return $this->rating->getSellerRating($id);
    }
}