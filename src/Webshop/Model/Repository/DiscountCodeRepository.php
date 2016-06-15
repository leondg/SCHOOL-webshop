<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\DiscountCode;

class DiscountCodeRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'discount_code';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return DiscountCode::class;
    }
}