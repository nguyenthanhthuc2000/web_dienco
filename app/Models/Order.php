<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Order extends Model
{
    // lệnh tạo model: php artisan make:model Order
    use HasFactory;
    protected $table = 'order'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db nêu dùng
    public $timestamps = true; // luu ngày tháng khi tạo sản phẩm
    protected $perPage = 5; // limit phân trang

    public function scopeOrderCode($query, $request)
    {
        if ($request->has('order_code') && $request->order_code != '') {
            $query->where('order_code', $request->order_code);
        }
        return $query;
    }
}
