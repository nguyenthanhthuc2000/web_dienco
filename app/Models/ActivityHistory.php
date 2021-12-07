<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityHistory extends Model
{
    use HasFactory;
    protected $table = 'activity_history'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db nêu dùng
    public $timestamps = true;
    protected $perPage = 15; // limit phân trang

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
