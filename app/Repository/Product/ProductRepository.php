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

<<<<<<< HEAD
    public function getMinPriceByCategory($category){
        $row = $this->model->select('price')->where('category', $category)->min('price');
        return $row;
    }
=======
//    public function scopeidProduct($query, $request)
//    {
//        return  $this->model->scopeId($query, $request);
//    }
//    public function scopeId($query, $request)
//    {
//        if ($request->has('id') && $request->id != '') {
//            $query->where('id', $request->id);
//        }
//        return $query;
//    }
>>>>>>> 67bfd8d1c5a1921cfdfbb41ea1d519976c5ad5a2
}
