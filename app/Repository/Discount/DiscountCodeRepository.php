<?php
namespace App\Repository\Discount;

use App\Models\DiscountCode;
use App\Repository\BaseRepository;

class DiscountCodeRepository extends BaseRepository implements DiscountCodeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        $m = new DiscountCode();
        return $m;
    }

}
