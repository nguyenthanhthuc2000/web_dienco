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

//    public function scopeidProduct($query, $request);
}
