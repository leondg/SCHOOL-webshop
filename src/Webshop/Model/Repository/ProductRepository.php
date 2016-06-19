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

    /**
     * @param $category
     *
     * @return array
     */
    public function findByCategory($category)
    {
        $records = $this->db->fetchAll(
            sprintf(
                'SELECT * FROM %s WHERE category = ?',
                $this->tableName()
            ),
            [(string) $category]
        );

        $products = [];
        if (!is_array($records)) {
            return $products;
        }

        foreach ($records as $record) {
            $products[] = Product::deserialize($record);
        }

        return $products;
    }
}
