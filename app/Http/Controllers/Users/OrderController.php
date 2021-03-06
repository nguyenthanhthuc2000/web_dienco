<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\DiscountCode;
use Mail;

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
                    $data = [
                        'total' => count($carts)
                    ];
                    return response()->json($data);
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

                $data = [
                    'total' => count($carts)
                ];
                return response()->json($data);
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
            $data = [
                'total' => count($carts)
            ];
            return response()->json($data);
        }

    }

    public function storeOrder(Request $request){
        $this->validate($request,
            //required = Kh??ng ???????c b??? tr???ng  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'email' => ['required'],
                'address' => ['required'],
                'phone' => ['required', 'max:12', 'min:10'],
                'note' => ['required'],
            ],
            //tr??? l???i th??ng b??o ??? giao di???n ph??a d?????i input // xem ??? trang view/admin/category/add
            [
                'name.required' => 'Vui l??ng nh???p t??n',
                'email.required' =>  'Vui l??ng nh???p ?????a ch??? email',
                'address.required' =>  'Vui l??ng nh???p ?????a ch??? nh???n h??ng',
                'phone.required' =>  'Vui l??ng nh???p s??? ??i???n tho???i',
                'note.required' =>  'Vui l??ng nh???p ghi ch??',
                'phone.max' =>  'Sai ?????nh d???ng',
                'phone.min' =>  'Sai ?????nh d???ng',
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

            $content = ''; // t??n sp/sl
            $total = Session::get('total'); //put ngo??i blade (trang gi??? h??ng) // tong don hang
            $reduce = 0; // tien giam
            if(Session::has('reduce')){
                $reduce = Session::get('reduce'); //put ngo??i blade (trang gi??? h??ng)
            }


            foreach (Session::get('carts') as $key => $cart) {
                $order_detail = new OrderDetail();
                $product = Product::find($cart['product_id']);
                $order_detail->order_code = $order_code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->quantily = $cart['product_qty'];
                if(Session::has('discount_code')){
                    $c = Session::get('discount_code');
                    $order_detail->discount_code_id = $c[0]['discount_id'];

                }
//                dd($total);
                $content .= '<p>'.$cart['product_qty'].': '.$product->name. '</p>';

                $order_detail->save();
            }
            //cap nhat lai sl ma giam gia
            if(Session::has('discount_code')){
                $discountCode = DiscountCode::find($c[0]['discount_id']);
                $array = [
                    'total' => $discountCode->total - 1,
                    'used' => $discountCode->used + 1
                ];
                $discountCode->update($array);
            }

            $title = 'X??c nh???n ????n h??ng c???a b???n t??? SAIGONSHOP.ABC';
            $email = $data['email'];
            //gui mail
            Mail::send('users.checkout.mail',
                array(
                'content' => $content,
                'order' => $order_code,
                'total' => $total,
                'reduce' => $reduce,
                'name' => $data['name'],
                'address' => $data['address']
            ),
                function ($message) use ($email, $title) {
                $message->to($email, $title)->subject($title);
            });



            Session::forget('discount_code');
            Session::forget('carts');
            return  redirect()->route('users.cart')->with('success', '?????t h??ng th??nh c??ng, ch??ng t??i s??? li??n h??? v???i b???n trong kho???ng th???i gian s???m nh???t!');
        }
        return redirect()->route('users.cart')->with('error', 'L???i, vui l??ng th??? l???i!');
    }

    public function updateCart(Request $request){

        $carts = session::get('carts');
        if($carts ==true){
            foreach ($request->qty as $key_qty => $qty) {
                foreach ($carts as $key_cart => $cart) {
                    if($cart['product_id'] == $key_qty){
                        $carts[$key_cart]['product_qty'] = $qty;

                    }
                }
            }
            Session::put('carts',$carts);

            if($request->discount_code != null){

                $discount = DiscountCode::where('code', $request->discount_code)->where('status',1)->first();
                if($discount == null){
                    return back()->with('error','M?? gi???m gi?? kh??ng t???n t???i!');
                }
                else{

                    if($discount->total > 0) {
                        $discount_code_session[] = array(
                            'discount_id' =>  $discount->id,
                            'discount_code' =>  $discount->code,
                            'discount_type' =>  $discount->type,
                            'discount_number' =>  $discount->number,
                        );
                        Session::put('discount_code', $discount_code_session);
                    }
                    else{
                        return back()->with('error', 'M?? gi???m gi?? h???t l?????t s??? d???ng!');
                    }

                }

            }

            return back()->with('success','C???p nh???t th??nh c??ng!');
        }else{
            return back()->with('error','Th??? l???i sau!');
        }
    }

    public function delProCart($id){
        $carts = Session::get('carts');
        if($carts == true){
            foreach($carts as $key => $cart) {
                if($id == $cart['product_id']){
                    unset($carts[$key]);
                }
            }
            Session::put('carts',$carts);
            return redirect()->route('users.cart')->with('success', 'X??a th??nh c??ng :((');
        }
        else{
            return redirect()->route('users.cart')->with('error', 'L???i, vui l??ng th??? l???i sau!');
        }
    }
}
