<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repository\Product\ProductRepositoryInterface;
use App\Repository\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $listProducts = $this->proRepo->getAll();
        $listCategories = $this->cateRepo->getAll();
        $data = [
            'listProducts' => $listProducts,
            'listCategories' => $listCategories
        ];
        return view('users.products.list_products', $data);
    }

    public function getByCategory($category){
        $idCategory = $this->cateRepo->getIdBySlug($category);
        $listProducts = $this->proRepo->getByAttributes(['category'=>$idCategory]);
        $listCategories = $this->cateRepo->getAll();
        $data = [
            'listProducts' => $listProducts,
            'listCategories' => $listCategories
        ];
        return view('users.products.list_products', $data);
    }

    public function detail($slug){
        $idProduct = $this->proRepo->getIdBySlug($slug);
        $details = $this->proRepo->find($idProduct)->toArray();
        $listCategories = $this->cateRepo->getAll();
        $data = [
            'detailProduct' => $details,
            'listCategories' => $listCategories
        ];
        return view('users.products.detail_product', $data);
    }
}
