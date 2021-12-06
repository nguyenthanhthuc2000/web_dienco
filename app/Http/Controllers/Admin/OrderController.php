<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Order\OrderRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepo;
    public function __construct(
        OrderRepositoryInterface $orderRepo
    ){
        $this->orderRepo = $orderRepo;
    }

    public function index(){
        $orders = $this->orderRepo->getAll();
        return view('admin.order.index', compact('orders'));
    }
}
