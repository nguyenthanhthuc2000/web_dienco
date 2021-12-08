<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Product\ProductRepositoryInterface;
use App\Repository\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $proRepo;
    protected $comRepo;

    public function __construct(
        ProductRepositoryInterface $proRepo,
        CommentRepositoryInterface $comRepo
    )
    {
        $this->proRepo = $proRepo;
        $this->comRepo = $comRepo;
    }
    public function index(){
        $data = [
            'comments' => $this->comRepo->getAll(),
            'products' => $this->proRepo->getAll(),
        ];
        return view('admin.comment.index', $data);
    }

    public function delete($id){
        if($this->comRepo->delete($id)){
            return redirect()->route('product.comment')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('product.comment')->with('error', 'Xóa thất bại!');
    }
}
