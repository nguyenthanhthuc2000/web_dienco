<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Discount\DiscountCodeRepositoryInterface;
use App\Repository\OrderDetail\OrderDetailRepositoryInterface;

class DiscountCodeController extends Controller
{

    protected $discountCodeRepo;
    protected $orderDetailRepo;

    public function __construct(
        DiscountCodeRepositoryInterface $discountCodeRepo,
        OrderDetailRepositoryInterface $orderDetailRepo
    )
    {
        $this->discountCodeRepo = $discountCodeRepo;
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function index(){
        $codes = $this->discountCodeRepo->getAll();
        return view('admin.code.index', compact('codes'));
    }

    public function add(){
        return view('admin.code.add');
    }

    public function store(Request $request){
        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'code' => [
                    "required",
                    "unique:App\Models\DiscountCode,code" // check xem code đã tồn tại chưa
                ]
//                'date_end' => ['required'],
//                'date_start' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin//add
            [
                'name.required' => 'Vui lòng nhập tên',
                'code.required' =>  'Vui lòng nhập code',
                'code.unique' =>  'Code này đã tồn tại'
//                'date_end.required' =>  'Vui lòng ngày kết thúc',
//                'date_start.required' =>  'Vui lòng ngày bắt đầu',
            ],
        );

        $array = [
            'name' => $request->name,
            'code' => $request->code,
//            'date_start' => $request->date_start,
//            'date_end' => $request->date_end,
            'number' => $request->number,
            'type' => $request->type,
            'status' => $request->status,
            'total' => $request->total,
            'used' => $request->used,
        ];

        //neu luu thanh cong quay ve trang danh sách
        if($this->discountCodeRepo->create($array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
            return redirect()->route('code.index')->with('success', 'Thêm thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('code.index')->with('error', 'Thêm thất bại!');
    }

    public function updateStatus($id){
        $statusCode =  $this->discountCodeRepo->find($id)->status; //lấy status hiện tại
        $status = 1;
        if($statusCode == 1){
            $status = 0;
        }
        $array = [
            'status' => $status
        ];
        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->discountCodeRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            return redirect()->route('code.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('code.index')->with('error', 'Cập nhật thất bại!');
    }

    public function delete($id){
        $attributes = [
            'discount_code_id' => $id
        ];
        $orderDetails = $this->orderDetailRepo->getByAttributesAll($attributes);
        $code = $this->discountCodeRepo->find($id);
        if($orderDetails->count() > 0){
            return redirect()->route('code.index')->with('error', 'Mã '.$code->code.' đã được dùng, không thể xóa !');
        }

        if($this->discountCodeRepo->delete($id)){
            return redirect()->route('code.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('code.index')->with('error', 'Xóa thất bại!');
    }

    public function edit($id){
        $code = $this->discountCodeRepo->find($id);
        return view('admin.code.edit', compact('code'));
    }

    public function update(Request $request, $id)
    {
        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'code' => ['required']
//                'date_end' => ['required'],
//                'date_start' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input // xem ở trang view/admin//add
            [
                'name.required' => 'Vui lòng nhập tên',
                'code.required' =>  'Vui lòng nhập code'
//                'date_end.required' =>  'Vui lòng ngày kết thúc',
//                'date_start.required' =>  'Vui lòng ngày bắt đầu',
            ],
        );

        //kiemtra trùng code
        $arrayCode = $this->discountCodeRepo->getAllItem()->whereNotIn('id', [$id])->pluck('code')->all(); // lấy danh sách code
        if(in_array($request->code, $arrayCode)){
            return redirect()->back()->withInput()->with('codeExist', 'Mã code đã tồn tại');
        }

        $array = [
            'name' => $request->name,
            'code' => $request->code,
//            'date_start' => $request->date_start,
//            'date_end' => $request->date_end,
            'number' => $request->number,
            'type' => $request->type,
            'status' => $request->status,
            'total' => $request->total,
            'used' => $request->used,
        ];

        //neu luu thanh cong quay ve trang danh sách
        if($this->discountCodeRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function create)
            return redirect()->route('code.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('code.index')->with('error', 'Cập nhật thất bại!');
    }
}
