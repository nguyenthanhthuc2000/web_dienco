<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    // lệnh tạo model: php artisan make:model DiscountCode
    use HasFactory;
    protected $table = 'discount_code'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db nêu dùng
    public $timestamps = true; // luu ngày tháng khi tạo sản phẩm
    protected $perPage = 5; // limit phân trang
}
