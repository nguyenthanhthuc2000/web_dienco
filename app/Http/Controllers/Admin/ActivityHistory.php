<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\ActivityHistory\ActivityHistoryRepositoryInterface;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class ActivityHistory extends Controller
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

    public function index(){
        $historys = $this->activityHistoryRepo->getAll();
        return view('admin.user.all_history', compact('historys'));
    }

    public function detail($id){
        $attributes = [
            'user_id' => $id
        ];
        $historys = $this->activityHistoryRepo->getByAttributes($attributes);
        $user = $this->userRepo->find($id);
        return view('admin.user.history', compact('historys', 'user'));
    }
}
