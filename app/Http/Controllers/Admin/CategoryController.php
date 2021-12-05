<?php

// lệnh tạo controller: php artisan make:controller Admin\CategoryController
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Category\CategoryRepositoryInterface; //thêm tay vào (chổ này mình tự tạo https://viblo.asia/p/trien-khai-repository-trong-laravel-m68Z0x6MZkG)

class CategoryController extends Controller
{
    protected $catRepo;

    public function __construct(
        CategoryRepositoryInterface $catRepo
    ){
        $this->catRepo = $catRepo;
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
                'name' => ['required'],
                'slug' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin/category/add
            [
                'name.required' => 'Vui lòng nhập tên',
                'slug.required' =>  'Vui lòng nhập slug',
            ],
        );
        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];

        //neu luu thanh cong quay ve trang danh sách
        if($this->catRepo->create($array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
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
        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];

        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->catRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('category.index')->with('error', 'Cập nhật thất bại!');
    }

    public function delete($id){

        if($this->catRepo->delete($id)){
            return redirect()->route('category.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Xóa thất bại!');
    }

    public function updateStatus($id){
        $statusCat =  $this->catRepo->find($id)->status; //lấy status hiện tại
        $status = 1;
        if($statusCat == 1){
            $status = 0;
        }
        $array = [
            'status' => $status
        ];
        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->catRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('category.index')->with('error', 'Cập nhật thất bại!');

    }

}
