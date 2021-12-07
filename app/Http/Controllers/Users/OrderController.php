<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

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
                        'product_name' => $product->tenvi,
                        'product_price' => $product->price,
                        'product_price_pro' => $product->price_pro,
                        'product_qty' => $data['cart_product_qty'] + $cart['product_qty'],
                        'product_photo' => $product->photo,
                    );
                    Session::put('carts',$carts);
                    return 1;
                }
            }
            if($is_avaiable == 0){
                $carts[] = array(
                    'session_id' => $session_id,
                    'product_id' => $product->id,
                    'product_name' => $product->tenvi,
                    'product_price' => $product->price,
                    'product_price_pro' => $product->price_pro,
                    'product_qty' => $data['cart_product_qty'],
                    'product_photo' => $product->photo,
                );
                Session::put('carts',$carts);
                return 1;
            }
        }
        else{//neu chua ton tai thi tao cart session va add pro vao
            $carts[] = array(
                'session_id' => $session_id,
                'product_id' => $product->id,
                'product_name' => $product->tenvi,
                'product_price' => $product->price,
                'product_price_pro' => $product->price_pro,
                'product_qty' => $data['cart_product_qty'],
                'product_photo' => $product->photo,
            );
            Session::put('carts',$carts);
            return 1;
        }

    }
}
