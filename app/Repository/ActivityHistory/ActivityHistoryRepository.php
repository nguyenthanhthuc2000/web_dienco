<?php
namespace App\Repository\ActivityHistory;

use App\Repository\BaseRepository;
use App\Models\ActivityHistory;

class ActivityHistoryRepository extends BaseRepository implements ActivityHistoryRepositoryInterface
{
    //lấy model tương ứng

    public function getModel()
    {
        $m = new ActivityHistory();
        return $m;
    }


}
