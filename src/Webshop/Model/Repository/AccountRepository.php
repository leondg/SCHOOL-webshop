<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\Account;

class AccountRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'account';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return Account::class;
    }
}