<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\OrderDetail;

use App\Repository\Order\OrderRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepo;
    public function __construct(
        OrderRepositoryInterface $orderRepo
    ){
        $this->orderRepo = $orderRepo;
    }

    public function index(Request $request){
//        $orders = $this->orderRepo->getAll();
        $orders = Order::OrderCode($request)->orderBy('id', 'DESC')->paginate(5);
        $orders->appends(['order_code' => $request->order_code]);
        return view('admin.order.index', compact('orders'));
    }

    public function delete($id){
        $order = $this->orderRepo->find($id);
        if($order){
            OrderDetail::where('order_code', $order->order_code)->delete();
            $this->orderRepo->delete($id);
            return redirect()->route('order.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('order.index')->with('error', 'Xóa thất bại!');
    }
}
