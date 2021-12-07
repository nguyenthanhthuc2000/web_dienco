<?php
namespace App\Repository\Category;

use App\Models\Category;
use App\Repository\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        $m = new Category();
        return $m;
    }
}
