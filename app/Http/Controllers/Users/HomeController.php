<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Repository\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $cateRepo;

    public function __construct(
        CategoryRepositoryInterface $cateRepo
    )
    {
        $this->cateRepo = $cateRepo;
    }
    public function index(){
        $listCategory = $this->cateRepo->getAll();
        return view('users.category.list_category', ['listCategory'=> $listCategory]);
    }
}
