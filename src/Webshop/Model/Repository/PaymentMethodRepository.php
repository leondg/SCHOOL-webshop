<?php
namespace Webshop\Model\Repository;

use Doctrine\DBAL\Connection;
use Webshop\Model\Entity\PaymentMethod;

class PaymentMethodRepository
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
     * @return PaymentMethod[]
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM payment_method';
        $records = $this->connection->fetchAll($sql);

        $paymentMethods = [];
        foreach ($records as $record) {
            $paymentMethods[] = PaymentMethod::deserialize($record);
        }

        return $paymentMethods;
    }
}