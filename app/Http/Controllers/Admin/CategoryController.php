<?php

// lệnh tạo controller: php artisan make:controller Admin\CategoryController
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Category\CategoryRepositoryInterface; //thêm tay vào (chổ này mình tự tạo https://viblo.asia/p/trien-khai-repository-trong-laravel-m68Z0x6MZkG)
use App\Repository\Product\ProductRepositoryInterface;
use App\Repository\ActivityHistory\ActivityHistoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use File; // them vao để thao  tác với file

class CategoryController extends Controller
{
    protected $catRepo;
    protected $proRepo;
    protected $activityHistoryRepo;

    public function __construct(
        CategoryRepositoryInterface $catRepo,
        ProductRepositoryInterface $proRepo,
        ActivityHistoryRepositoryInterface $activityHistoryRepo
    ){
        $this->catRepo = $catRepo;
        $this->proRepo = $proRepo;
        $this->activityHistoryRepo = $activityHistoryRepo;
    }

    public function index(){
        //có lấy phân trang xem ở model: App\Models\Category
        $cats = $this->catRepo->getAll(); //lấy tất cả danh mục qua hàm getAll ở App\Repository\BaseRepository\ getAll()
        return view('admin.category.index', compact('cats')); // chuyen den trang danh sách category kèm theo dữ liệu category
    }

    public function add(){
        return view('admin.category.add');
    }

    public function store(Request $request){

        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => [
                    'required',
                    "unique:App\Models\Category,name" // check xem name đã tồn tại chưa
                ],
                'slug' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin/category/add
            [
                'name.required' => 'Vui lòng nhập tên',
                'name.unique' => 'Tên danh mục đã tồn tại',
                'slug.required' =>  'Vui lòng nhập slug',
            ],
        );
        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];
        if($request->file('image')){
            //tạo tên mới cho ảnh để k bị trùng
            $image = substr(md5(microtime()),rand(0,5), 6).'-'.$request->file('image')->getClientOriginalName();
            //lưu ảnh vào /upload/products
            $request->file('image')->move('upload/categories/', $image);
            $array = $array + array('image' => $image);
        }

        //neu luu thanh cong quay ve trang danh sách
        $insert = $this->catRepo->create($array);
        if($insert){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
            $arrayHistory = [
                'user_id' => Auth::id(),
                'action' => 'Thêm mới danh mục sản phẩm ID: '.$insert->id
            ];
            $this->activityHistoryRepo->create($arrayHistory);
            return redirect()->route('category.index')->with('success', 'Thêm thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('category.index')->with('error', 'Thêm thất bại!');
    }

    public function edit($id){
        $cat = $this->catRepo->find($id);
        return view('admin.category.edit', compact('cat'));
    }

    public function update(Request $request, $id){
        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'slug' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin/category/add
            [
                'name.required' => 'Vui lòng nhập tên',
                'slug.required' =>  'Vui lòng nhập slug',
            ],
        );

        //kiemtra trùng name
        $arrayName = $this->catRepo->getAllItem()->whereNotIn('id', [$id])->pluck('name')->all(); // lấy danh sách name
        if(in_array($request->name, $arrayName)){
            return redirect()->back()->withInput()->with('nameExist', 'Tên đã đã tồn tại');
        }

        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];
        if($request->file('image')){
            $cat = $this->catRepo->find($id);
            if(File::exists(public_path()."/upload/categories/".$cat->image)){
                File::delete(public_path()."/upload/categories/".$cat->image);
            }
            //tạo tên mới cho ảnh để k bị trùng
            $image = substr(md5(microtime()),rand(0,5), 6).'-'.$request->file('image')->getClientOriginalName();
            //lưu ảnh vào /upload/products
            $request->file('image')->move('upload/categories/', $image);
            $array = $array + array('image' => $image);
        }

        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->catRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            $arrayHistory = [
                'user_id' => Auth::id(),
                'action' => 'Cập nhật thông tin danh mục sản phẩm ID: '.$id
            ];
            $this->activityHistoryRepo->create($arrayHistory);
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('category.index')->with('error', 'Cập nhật thất bại!');
    }

    public function delete($id){

        $attributes = [
            'category' => $id
        ];
        $products = $this->proRepo->getByAttributesAll($attributes);
        $category = $this->catRepo->find($id);
        if($products->count() > 0){
            return redirect()->route('category.index')->with('error', 'Tồn tại '.$products->count().' sản phẩm thuộc danh mục '.$category->name.', không thể xóa !');
        }
        if($this->catRepo->delete($id)){
            return redirect()->route('category.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Xóa thất bại!');
    }

    public function updateStatus($id){
        $statusCat =  $this->catRepo->find($id)->status; //lấy status hiện tại
        $status = 1;
        $mes = 'hoạt động';
        if($statusCat == 1){
            $status = 0;
            $mes = 'ngừng hoạt động';
        }
        $array = [
            'status' => $status
        ];
        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->catRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            $arrayHistory = [
                'user_id' => Auth::id(),
                'action' => 'Cập nhật trạng thái danh mục sản phẩm ID: '.$id.' thành '.$mes
            ];
            $this->activityHistoryRepo->create($arrayHistory);
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('category.index')->with('error', 'Cập nhật thất bại!');

    }

}
