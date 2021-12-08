<?php
namespace App\Repository\Product;

use App\Models\Product;
use App\Repository\BaseRepository;
//use Illuminate\Database\Eloquent\Scope;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    //lấy model tương ứng
    public function getModel()
    {
        $m = new Product();
        return $m;
    }

    public function getMinPriceByCategory($category){
        $row = $this->model->select('price')->where('category', $category)->min('price');
        return $row;
    }

    public function getProductOrderByPrice($column, $order = 'desc', $attributes = [], $from = null, $to = null){
        if($from != null && $to != null){
            return $this->model->where($attributes)->where('status', 1)->whereBetween($column, [$from, $to])->orderBy($column, $order)->paginate();
        }
        return $this->model->where($attributes)->where('status', 1)->orderBy($column, $order)->paginate();
    }
}
