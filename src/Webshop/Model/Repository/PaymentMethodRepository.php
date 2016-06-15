<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\PaymentMethod;

class PaymentMethodRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'payment_method';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return PaymentMethod::class;
    }
}