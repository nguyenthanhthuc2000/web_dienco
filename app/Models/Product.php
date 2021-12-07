<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    // lệnh tạo model: php artisan make:model Product
    use HasFactory;
    protected $table = 'product'; // tên bảng trong db
    protected $guarded = [];    // lưu được tất cả các trường trong db nêu dùng
    // protected $fillable = ['name', 'slug', 'status']; thì chỉ lưu được 3 trường đó
    public $timestamps = true; // luu ngày tháng khi tạo sản phẩm
    protected $perPage = 6; // limit phân trang
    // protected $perPage = 5; // limit phân trang

    public function scopeId($query, $request)
    {
//        dd('ok');
        if ($request->has('id') && $request->id != '') {
            $query->where('id', $request->id);
        }
        return $query;
    }

}
