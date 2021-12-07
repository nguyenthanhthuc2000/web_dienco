<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Repository\ActivityHistory\ActivityHistoryRepositoryInterface;
use DB;

class UserController extends Controller
{
    protected $userRepo;
    protected $activityHistoryRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        ActivityHistoryRepositoryInterface $activityHistoryRepo
    )
    {
        $this->userRepo = $userRepo;
        $this->activityHistoryRepo = $activityHistoryRepo;
    }

    public function history($id){
        $attributes = [
            'user_id' => $id
        ];
        $historys = $this->activityHistoryRepo->getByAttributes($attributes);
        $user = $this->userRepo->find($id);
        return view('admin.user.history', compact('historys', 'user'));
    }

    public function index(Request $request){

        $users = User::FilterEmail($request)->orderBy('id', 'DESC')->paginate(5);
        $users->appends(['email' => $request->email]);
        return view('admin.user.index', compact('users'));
    }

    public function add(){
        return view('admin.user.add');
    }

    public function resetPassword($id){

        $newPassword = substr(md5(microtime()),rand(0,5), 6);
        $user = $this->userRepo->find($id);
        $array = [
            'password' => Hash::make($newPassword),
        ];
        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->userRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            return redirect()->route('user.index')->with('success', 'Cập nhật mật khẩu mới cho tài khoản '.$user->email.' là: '.$newPassword);
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('user.index')->with('error', 'Cập nhật thất bại!');

    }

    public function store(Request $request)
    {

        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'email' => [
                    'required',
                    "unique:App\Models\User,email" // check xem email đã tồn tại chưa
                ],
                'password' => ['required'],
            ],
            //trả lại thông báo ở giao diện phía dưới input
            [
                'name.required' => 'Vui lòng nhập tên tài khoản',
                'email.required' => 'Vui lòng nhập email',
                'email.unique' => 'Địa chỉ email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
            ],
        );
        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ];

        //neu luu thanh cong quay ve trang danh sách
        if ($this->userRepo->create($array)) {
            return redirect()->route('user.index')->with('success', 'Thêm thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('user.index')->with('error', 'Thêm thất bại!');
    }

    public function edit($id){
        $user = $this->userRepo->find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        //validate du lieu -- neu lỗi sẽ hiện ở giao diện form phía dưới input
        $this->validate($request,
            //required = Không được bỏ trống  https://laravel.com/docs/8.x/validation#rule-required
            [
                'name' => ['required'],
                'email' => [
                    'required',
                ],
            ],
            //trả lại thông báo ở giao diện phía dưới input
            [
                'name.required' => 'Vui lòng nhập tên tài khoản',
                'email.required' => 'Vui lòng nhập email',
            ],
        );
        //tao mang chua du lieu can insert //name slug status
        $array = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ];

        //kiemtra trùng code
        $arrayCode = $this->userRepo->getAllItem()->whereNotIn('id', [$id])->pluck('email')->all(); // lấy danh sách code
        if(in_array($request->code, $arrayCode)){
            return redirect()->back()->withInput()->with('emailExist', 'Địa chỉ email đã tồn tại');
        }


        //neu luu thanh cong quay ve trang danh sách
        if ($this->userRepo->update($id, $array)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('user.index')->with('error', 'Cập nhật thất bại!');
    }

    public function updateStatus($id){
        $statusUser =  $this->userRepo->find($id)->status; //lấy status hiện tại
        $status = 1;
        if($statusUser == 1){
            $status = 0;
        }
        $array = [
            'status' => $status
        ];
        //neu cập nhật thanh cong quay ve trang danh sách
        if($this->userRepo->update($id, $array)){ // goi đến catRepo ở function construct (app/Repository/BaseRepository/ function update)
            return redirect()->route('user.index')->with('success', 'Cập nhật thành công!');
        }
        //neu that bai quay ve trang danh sách
        return redirect()->route('user.index')->with('error', 'Cập nhật thất bại!');

    }

    public function delete($id){

        if($this->userRepo->delete($id)){
            return redirect()->route('user.index')->with('success', 'Xóa thành công!');
        }
        return redirect()->route('user.index')->with('error', 'Xóa thất bại!');
    }

}
