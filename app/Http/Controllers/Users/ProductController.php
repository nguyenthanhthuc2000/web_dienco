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

    public function index(Request $request){
        $listProducts = $this->proRepo->getAllActive();
        if($request->from && $request->to && $request->sort){
            if($request->sort == 'up'){
                $listProducts = $this->proRepo->getProductOrderByPrice('price', 'asc', [], $request->from, $request->to);
            }
            if($request->sort == 'down'){
                $listProducts = $this->proRepo->getProductOrderByPrice('price', 'desc', [], $request->from, $request->to);
            }
        }
        $listCategories = $this->cateRepo->getAllActive();
        $data = [
            'listProducts' => $listProducts,
            'listCategories' => $listCategories
        ];
        return view('users.products.list_products', $data);
    }

    public function getByCategory(Request $request, $category){
        $idCategory = $this->cateRepo->getIdBySlug($category);
        $listProducts = $this->proRepo->getByAttributes(['category'=>$idCategory]);
        if($request->from && $request->to && $request->sort){
            if($request->sort == 'up'){
                $listProducts = $this->proRepo->getProductOrderByPrice('price', 'asc', ['category'=>$idCategory], $request->from, $request->to);
            }
            if($request->sort == 'down'){
                $listProducts = $this->proRepo->getProductOrderByPrice('price', 'desc', ['category'=>$idCategory], $request->from, $request->to);
            }
        }
        $listCategories = $this->cateRepo->getAllActive();
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

    // public function sort(Request $request){
    //     $listProducts = $this->proRepo->getProductOrderBy('price');
    //     if($request->sort == 'up'){
    //         $listProducts = $this->proRepo->getProductOrderBy('price', 'desc');
    //     }
    //     $listCategories = $this->cateRepo->getAll();
    //     // dd()
    //     $data = [
    //         'listProducts' => $listProducts,
    //         'listCategories' => $listCategories
    //     ];
    //     return view('users.products.list_products', $data);
    // }
}
