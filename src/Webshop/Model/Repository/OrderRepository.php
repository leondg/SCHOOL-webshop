<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\Order;

class OrderRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'order';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return Order::class;
    }
}