<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

use App\Repository\Order\OrderRepositoryInterface;
use App\Repository\ActivityHistory\ActivityHistoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $activityHistoryRepo;
    public function __construct(
        OrderRepositoryInterface $orderRepo,
        ActivityHistoryRepositoryInterface $activityHistoryRepo
    ){
        $this->orderRepo = $orderRepo;
        $this->activityHistoryRepo = $activityHistoryRepo;
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

    public function detail($order_code){
        // lấy danh chi tiết hóa don (bảng order_detail)
        $products = OrderDetail::where('order_code', $order_code)->get();
        //lấy thông tin hóa đơn (order)
        $order = Order::where('order_code', $order_code)->first();

        return view('admin.order.detail', compact('products', 'order'));
    }

    public function updateStatus(Request $request){
        $order = Order::find($request->id);
        $order->status = $request->status;
        if($order->save()){

            //lấy chi tiết hóa đon
            $orderDetail = OrderDetail::where('order_code', $order->order_code)->get();

            //dang xu li = 2 (giao hàng) -- cap nhật lại số lượng trong tồn và sl đã bán
            if($request->status == 1 || $request->status == 2){
                //xứ lí cập nhật
                if($order->check_status == 0){
                    foreach ($orderDetail as $pro){
                        $product = Product::find($pro->product_id);
                        $array = [
                            'quantity' => $product->quantity + $pro->quantily,
                            'remains' => $product->remains - $pro->quantily,
                        ];
                        $order->update(['check_status' => 1]);
                        $product->update($array);
                    }

                }

                $arrayHistory = [
                    'user_id' => Auth::id(),
                    'action' => 'Cập nhật trạng thái hóa đơn ID: '.$order->order_code.' thành: '.$request->txt_status
                ];
                $this->activityHistoryRepo->create($arrayHistory);
            }

            //Hủy --  = 0 (giao hàng) -- cap nhật lại số lượng trong tồn và sl đã bán
            if($request->status ==  3 || $request->status ==  0){
                //xứ lí cập nhật
                if($order->check_status == 1) {
                    foreach ($orderDetail as $pro) {
                        $product = Product::find($pro->product_id);
                        $array = [
                            'quantity' => $product->quantity - $pro->quantily,
                            'remains' => $product->remains + $pro->quantily,
                        ];
                        $product->update($array);
                        $order->update(['check_status' => 0]);
                    }

                }
                $arrayHistory = [
                    'user_id' => Auth::id(),
                    'action' => 'Cập nhật trạng thái hóa đơn ID: '.$order->order_code.' thành: '.$request->txt_status
                ];
                $this->activityHistoryRepo->create($arrayHistory);
            }


            return 1;
        }
        return 0;
    }
}
