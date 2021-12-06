<?php
namespace App\Repository\User;

use App\Models\User;
use App\Repository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        $m = new User();
        return $m;
    }
}
