<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function cart(){
        return view('users.order.index');
    }

    public function addToCart(Request $request){
        $data = $request->all();
        $product = Product::find($data['id']);
        $session_id = substr(md5(microtime()),rand(0,5), 6);
        // dd($session_id);
        $carts = Session::get('carts'); // lay session cart
        if($carts == true){ //kiem tra ton tai cart chua, neu ton tai roi thi add pro vao
            $is_avaiable = 0; //kiem tra xem co pro do trong session chua, neu co thi update qty k thi tao session cart cho pro do
            foreach ($carts as $key => $cart) {
                if($cart['product_id'] == $product->id){
                    $is_avaiable++;
                    $carts[$key] = array( //cart[$key]  la lay cart dang trong foreach
                        'session_id' => $session_id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_price' => $product->price,
                        'product_qty' => $data['cart_product_qty'] + $cart['product_qty'],
                        'product_image' => $product->image,
                    );
                    Session::put('carts',$carts);
                    return 1;
                }
            }
            if($is_avaiable == 0){
                $carts[] = array(
                    'session_id' => $session_id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'product_qty' => $data['cart_product_qty'],
                    'product_image' => $product->image,
                );
                Session::put('carts',$carts);
                return 1;
            }
        }
        else{//neu chua ton tai thi tao cart session va add pro vao
            $carts[] = array(
                'session_id' => $session_id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_qty' => $data['cart_product_qty'],
                'product_image' => $product->image,
            );
            Session::put('carts',$carts);
            return 1;
        }

    }

    public function storeOrder(Request $request){
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $data = $request->all();
//        $Order = new Order();
//        $Order->name = $data['name'];
//        $Order->address = $data['address'];
//        $Order->phone = $data['phone'];
//        $Order->email = $data['email'];
//        $Order->total_money = $data['note'];
//        $Order->save();
//
//        $order_code = 'HD'.substr(md5(microtime()),rand(0,26),6);
//
//        if(Session::get('carts')){
//            foreach (Session::get('carts') as $key => $cart) {
//                $order_detail = new OrderDetail();
//                $order_detail->order_code = $order_code;
//                $order_detail->product_id =$cart['product_id'];
//                $order_detail->product_qty = $cart['product_qty'];
//                $order_detail->shipping_cou = $data['shipping_cou'];
//                $order_detail->save();
//            }
//        }
//        Session::forget('carts');
//        Session::forget('coupon_session');
//        return 1;
    }
}
