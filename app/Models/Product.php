<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // lệnh tạo model: php artisan make:model Product
    use HasFactory;
    protected $table = 'product'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db nêu dùng
    // protected $fillable = ['name', 'slug', 'status']; thì chỉ lưu được 3 trường đó
    public $timestamps = true; // luu ngày tháng khi tạo sản phẩm
    protected $perPage = 6; // limit phân trang
}
