<?php
namespace App\Repository\Product;

use App\Repository\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getMinPriceByCategory($category){
        $row = $this->model->select('price')->where('category', $category)->min('price');
        return $row;
    }
}
