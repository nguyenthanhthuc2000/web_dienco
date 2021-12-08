<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // lệnh tạo model: php artisan make:model OrderDetail
    use HasFactory;
    protected $table = 'order_detail'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db
    public $timestamps = true;
    protected $perPage = 5; // limit phân trang

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function discount_code(){
        return $this->hasOne(DiscountCode::class, 'id', 'discount_code_id');
    }

}
