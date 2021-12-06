<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Product\ProductRepositoryInterface;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\OrderDetail\OrderDetailRepositoryInterface;

use File; // them vao để thao  tác với file


class ProductController extends Controller
{
    protected $proRepo;
    protected $catRepo;
    protected $orderDetailRepo;

    public function __construct(
        ProductRepositoryInterface $proRepo,
        CategoryRepositoryInterface $catRepo,
        OrderDetailRepositoryInterface $orderDetailRepo
    )
    {
        $this->proRepo = $proRepo;
        $this->catRepo = $catRepo;
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function store(Request $request){
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
        if($this->proRepo->create($array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
            return redirect()->route('product.index')->with('success', 'Thêm thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('product.index')->with('error', 'Thêm thất bại!');
    }

    public function index(){

        $products = $this->proRepo->getAll();
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
        $status = 1;
        if($statusPro == 1){
            $status = 0;
        }
        $array = [
            'status' => $status
        ];
        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->proRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('product.index')->with('error', 'Cập nhật thất bại!');

    }

    public function delete($id){
        $attributes = [
            'id_product' => $id
        ];
        $orderDetails = $this->orderDetailRepo->getByAttributesAll($attributes);
        $products = $this->proRepo->find($id);
        if($orderDetails->count() > 0){
            return redirect()->route('product.index')->with('error', 'Tồn tại '.$orderDetails->count().' hóa đơn thuộc sản phẩm '.$products->name.', không thể xóa !');
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
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('product.index')->with('error', 'Cập nhật thất bại!');
    }
}
