<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $cateRepo;
    protected $proRepo;

    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        ProductRepositoryInterface $proRepo
    )
    {
        $this->cateRepo = $cateRepo;
        $this->proRepo = $proRepo;
    }
    public function index(){
        $listCategory = $this->cateRepo->getAllActive(); // lấy ra danh sách category
        $lstMinPrice = [];
        foreach($listCategory as $category){
            $price = ($this->proRepo->getMinPriceByCategory($category->id)) ? $this->proRepo->getMinPriceByCategory($category->id) : '0'; //lấy giá nhỏ nhất của sản phẩm trong cùng 1 category 
            array_push($lstMinPrice,['idCategory' => $category->id, 'minPrice' => $price]); //push vào mảng
        }
        return view('users.category.list_category', ['listCategory'=> $listCategory, 'minPrice' => $lstMinPrice]);
    }
}
