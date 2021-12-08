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
        $listCategory = $this->cateRepo->getAllActive();
        return view('users.category.list_category', ['listCategory'=> $listCategory]);
    }
}
