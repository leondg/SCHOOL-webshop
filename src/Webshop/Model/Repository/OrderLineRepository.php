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

    public function findByOrderId($orderId)
    {
        $records = $this->db->fetchAll(
            sprintf(
                'SELECT * FROM %s WHERE order_id = ?',
                $this->tableName()
            ),
            [(int) $orderId]
        );

        $orderLines = [];
        foreach ($records as $record) {
            $orderLines[] = OrderLine::deserialize($record);
        }

        return $orderLines;
    }
}
