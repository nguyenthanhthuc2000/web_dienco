<?php
namespace App\Repository\OrderDetail;

use App\Models\OrderDetail;
use App\Repository\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        $m = new OrderDetail();
        return $m;
    }


}
