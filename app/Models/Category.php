<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // lệnh tạo model: php artisan make:model Category
    use HasFactory;
    protected $table = 'category'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db nêu dùng
                                // protected $fillable = ['name', 'slug', 'status']; thì chỉ lưu được 3 trường đó
    public $timestamps = true; // luu ngày tháng khi tạo sản phẩm
    protected $perPage = 9; // limit phân trang

}
