<?php
namespace App\Repository\Discount;

use App\Repository\BaseRepository;

class DiscountCodeRepository extends BaseRepository implements DiscountCodeRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\DiscountCode::class;
    }

}
