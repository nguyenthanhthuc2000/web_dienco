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
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'email' => ['required'],
                'address' => ['required'],
                'phone' => ['required', 'max:12'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin/category/add
            [
                'name.required' => 'Vui lòng nhập tên',
                'email.required' =>  'Vui lòng nhập địa chỉ email',
                'address.required' =>  'Vui lòng nhập địa chỉ nhận hàng',
                'phone.required' =>  'Vui lòng nhập số điện thoại',
                'phone.max' =>  'Sai định dạng',
            ],
        );


//        dd($request->all());
        if(Session::get('carts')){
            $order_code = 'HD'.substr(md5(microtime()),rand(0,26),6);

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = $request->all();
            $Order = new Order();
            $Order->order_code = $order_code;
            $Order->name = $data['name'];
            $Order->address = $data['address'];
            $Order->phone = $data['phone'];
            $Order->email = $data['email'];
            $Order->note = $data['note'];
            $Order->total_money = $data['total'];
            $Order->save();

            foreach (Session::get('carts') as $key => $cart) {
                $order_detail = new OrderDetail();
                $order_detail->order_code = $order_code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->quantily = $cart['product_qty'];
                if(Session::has('discount_code')){
                    $c = Session::get('discount_code');
                    $order_detail->discount_code_id = $c['discount_code'];
                    Session::forget('discount_code');
                }
                $order_detail->save();
            }
            Session::forget('carts');
            return  redirect()->route('users.cart')->with('success', 'Đặt hàng thành công, chúng tôi sẽ liên hệ với bạn trong khoảng thời gian sớm nhất!');
        }
        return redirect()->route('users.cart')->with('error', 'Lỗi, vui lòng thử lại!');
    }

    public function updateCart(Request $request){

    }
}
