<?php
namespace App\Repository\Order;

use App\Models\Order;
use App\Repository\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        $m = new Order();
        return $m;
    }

}
