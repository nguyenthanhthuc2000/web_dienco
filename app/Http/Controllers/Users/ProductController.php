<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repository\Product\ProductRepositoryInterface;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $cateRepo;
    protected $comRepo;
    protected $proRepo;

    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        CommentRepositoryInterface $comRepo,
        ProductRepositoryInterface $proRepo
    )
    {
        $this->cateRepo = $cateRepo;
        $this->comRepo = $comRepo;
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
        $listComments = $this->comRepo->getByAttributes(['id_product' => $idProduct]);
        $details = $this->proRepo->find($idProduct)->toArray();
        $listCategories = $this->cateRepo->getAll();
        $data = [
            'detailProduct' => $details,
            'listCategories' => $listCategories,
            'listComments' => $listComments
        ];
        return view('users.products.detail_product', $data);
    }

    public function comment(Request $request){
        $data = [
            'id_product' => $request->id_product,
            'name' => $request->name,
            'contents' => $request->content
        ];
        $done = $this->comRepo->create($data);
        if($done){
            return back()->with('success', 'ok');
        }
    }
}
