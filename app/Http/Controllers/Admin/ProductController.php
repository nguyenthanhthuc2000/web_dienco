<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repository\Product\ProductRepositoryInterface;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\OrderDetail\OrderDetailRepositoryInterface;
use App\Repository\ActivityHistory\ActivityHistoryRepositoryInterface;
use DB;

use File; // them vao để thao  tác với file


class ProductController extends Controller
{
    protected $proRepo;
    protected $catRepo;
    protected $orderDetailRepo;
    protected $activityHistoryRepo;

    public function __construct(
        ProductRepositoryInterface $proRepo,
        CategoryRepositoryInterface $catRepo,
        OrderDetailRepositoryInterface $orderDetailRepo,
        ActivityHistoryRepositoryInterface $activityHistoryRepo
    )
    {
        $this->proRepo = $proRepo;
        $this->catRepo = $catRepo;
        $this->orderDetailRepo = $orderDetailRepo;
        $this->activityHistoryRepo = $activityHistoryRepo;
    }

    public function store(Request $request){
        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => [
                    'required',
                    "unique:App\Models\Product,name" // check xem name đã tồn tại chưa
                ],
                'slug' => ['required'],
                'category' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin/category/add
            [
                'name.required' => 'Vui lòng nhập tên',
                'name.unique' => 'Tên sản phẩm đã tồn tại',
                'slug.required' =>  'Vui lòng nhập slug',
                'category.required' =>  'Vui lòng chọn danh mục',
            ],
        );
        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'category' => $request->category,
            'remains' => $request->remains,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'price' => $request->price,
            'origin' => $request->origin,
        ];
        if($request->file('image')){
            //tạo tên mới cho ảnh để k bị trùng
            $image = substr(md5(microtime()),rand(0,5), 6).'-'.$request->file('image')->getClientOriginalName();
            //lưu ảnh vào /upload/products
            $request->file('image')->move('upload/products/', $image);
            $array = $array + array('image' => $image);
        }

        //neu luu thanh cong quay ve trang danh sách
        $insert = $this->proRepo->create($array);
        if($insert){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
            $arrayHistory = [
                'user_id' => Auth::id(),
                'action' => 'Thêm mới sản phẩm ID: '.$insert->id
            ];
            $this->activityHistoryRepo->create($arrayHistory);
            return redirect()->route('product.index')->with('success', 'Thêm thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('product.index')->with('error', 'Thêm thất bại!');
    }

    public function index(Request $request){

//        $products = $this->proRepo->scopeidProduct($request);
//        $products->scopeidProduct($request);
        $products = Product::Id($request)->orderBy('id', 'DESC')->paginate(5);
        $products->appends(['id' => $request->id]);

        return view('admin.product.index', compact('products'));
    }

    public function add(){
        $attributes = [
            'status' => 1
        ];
        $categorys = $this->catRepo->getByAttributesAll($attributes);
        return view('admin.product.add', compact('categorys'));
    }

    public function updateStatus(Request $request, $id){
        $statusPro =  $this->proRepo->find($request->id)->status; //lấy status hiện tại
        $mes = 'hoạt động';
        $status = 1;
        if($statusPro == 1){
            $status = 0;
            $mes = 'ngừng hoạt động';
        }
        $array = [
            'status' => $status
        ];

        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->proRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            $arrayHistory = [
                'user_id' => Auth::id(),
                'action' => 'Cập nhật trạng thái sản phẩm ID: '.$id.' thành '.$mes
            ];
            $this->activityHistoryRepo->create($arrayHistory);
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('product.index')->with('error', 'Cập nhật thất bại!');

    }

    public function delete($id){
        $attributes = [
            'product_id' => $id
        ];
        $orderDetails = $this->orderDetailRepo->getByAttributesAll($attributes);
        $products = $this->proRepo->find($id);
        if($orderDetails->count() > 0){
            return redirect()->route('product.index')->with('error', 'Đã bán '.$orderDetails->count().' sản phẩm '.$products->name.', không thể xóa !');
        }
        if($this->proRepo->delete($id)){
            return redirect()->route('product.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('product.index')->with('error', 'Xóa thất bại!');
    }

    public function edit($id){
        $attributes = [
            'status' => 1
        ];
        $categorys = $this->catRepo->getByAttributesAll($attributes);
        $product = $this->proRepo->find($id);
        return view('admin.product.edit', compact('categorys', 'product'));
    }

    public function update(Request $request, $id){
        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'slug' => ['required'],
                'category' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin/category/add
            [
                'name.required' => 'Vui lòng nhập tên',
                'slug.required' =>  'Vui lòng nhập slug',
                'category.required' =>  'Vui lòng chọn danh mục',
            ],
        );

        //kiemtra trùng name
        $arrayName = $this->proRepo->getAllItem()->whereNotIn('id', [$id])->pluck('name')->all(); // lấy danh sách name
        if(in_array($request->name, $arrayName)){
            return redirect()->back()->withInput()->with('nameExist', 'Tên đã đã tồn tại');
        }

        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'category' => $request->category,
            'remains' => $request->remains,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'price' => $request->price,
            'origin' => $request->origin,
        ];
        if($request->file('image')){
            $pro = $this->proRepo->find($id);
            if(File::exists(public_path()."/upload/products/".$pro->image)){
                File::delete(public_path()."/upload/products/".$pro->image);
            }
            //tạo tên mới cho ảnh để k bị trùng
            $image = substr(md5(microtime()),rand(0,5), 6).'-'.$request->file('image')->getClientOriginalName();
            //lưu ảnh vào /upload/products
            $request->file('image')->move('upload/products/', $image);
            $array = $array + array('image' => $image);
        }

        //neu luu thanh cong quay ve trang danh sách
        if($this->proRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
            $arrayHistory = [
                'user_id' => Auth::id(),
                'action' => 'Chỉnh sửa thông tin sản phẩm ID: '.$id
            ];
            $this->activityHistoryRepo->create($arrayHistory);
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('product.index')->with('error', 'Cập nhật thất bại!');
    }
}
