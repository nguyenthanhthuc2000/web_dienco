<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\OrderDetail\OrderDetailRepositoryInterface;

class OrderDetailController extends Controller
{
    protected $orderDetailRepo;
    public function __construct(
        OrderDetailRepositoryInterface $orderDetailRepo
    ){
        $this->orderDetailRepo = $orderDetailRepo;
    }
}
