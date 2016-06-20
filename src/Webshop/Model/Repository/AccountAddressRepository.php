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

    public function findByAccount($account)
    {
        $records = $this->db->fetchAll(
            sprintf(
                'SELECT * FROM %s WHERE account_id = ?',
                $this->tableName()
            ),
            [(string) $account]
        );

        $result = [];
        if (!is_array($records)) {
            return $result;
        }

        foreach ($records as $record) {
            $result[] = AccountAddress::deserialize($record);
        }

        return $result;
    }
}
