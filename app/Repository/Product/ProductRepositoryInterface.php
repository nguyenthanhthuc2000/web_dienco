<?php
namespace App\Repository\Product;

use App\Repository\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $category
     * @return int
     */
    public function getMinPriceByCategory($category);
}
