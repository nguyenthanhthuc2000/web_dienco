<?php
namespace App\Repository\ActivityHistory;

use App\Repository\BaseRepository;

class ActivityHistoryRepository extends BaseRepository implements ActivityHistoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ActivityHistory::class;
    }

}
