<?php
namespace Webshop\Model\Repository;

use Doctrine\DBAL\Connection;
use Webshop\Model\Entity\Product;

class ProductRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Product[]
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM product';
        $records = $this->connection->fetchAll($sql);

        $products = [];
        foreach ($records as $record) {
            $products[] = Product::deserialize($record);
        }

        return $products;
    }

    /**
     * @param $id
     * @return Product
     */
    public function findById($id)
    {
        $sql = 'SELECT * FROM product WHERE id = ?';
        $record = $this->connection->fetchAssoc($sql, [(int) $id]);

        return Product::deserialize($record);
    }

    /**
     * @param $name
     * @return Product
     */
    public function findByName($name)
    {
        $sql = 'SELECT * FROM product WHERE name = ?';
        $record = $this->connection->fetchAssoc($sql, [(string) $name]);

        return Product::deserialize($record);
    }

    /**
     * @param $category
     * @return Product
     */
    public function findByCategory($category)
    {
        $sql = 'SELECT * FROM product WHERE category = ?';
        $record = $this->connection->fetchAssoc($sql, [(string) $category]);

        return Product::deserialize($record);
    }
}