<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\Product;

class ProductRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'product';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return Product::class;
    }
}