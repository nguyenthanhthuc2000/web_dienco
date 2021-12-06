<?php
namespace App\Repository\OrderDetail;

use App\Repository\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\OrderDetail::class;
    }

}
