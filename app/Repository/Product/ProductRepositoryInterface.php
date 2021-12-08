<?php
namespace App\Repository\Product;

use App\Repository\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $category
     * @return mixed
     */
    public function getMinPriceByCategory($category);

    /**
     * @param string $column
     * @return mixed
     */
    public function getProductOrderByPrice($column, $order = 'desc', $attributes = [], $from = null, $to = null);

//    public function scopeidProduct($query, $request);
}
