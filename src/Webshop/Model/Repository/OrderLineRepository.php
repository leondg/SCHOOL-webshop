<?php

namespace Webshop\Model\Repository;

use Webshop\Model\Entity\OrderLine;

class OrderLineRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'order_line';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        OrderLine::class;
    }
}
