<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\AccountAddress;

class AccountAddressRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'account_address';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        AccountAddress::class;
    }
}