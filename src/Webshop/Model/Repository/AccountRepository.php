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

    public function findByUsername($username)
    {
        $record = $this->db->fetchAssoc(
            sprintf(
                'SELECT * FROM %s WHERE username = ? LIMIT 1',
                $this->tableName()
            ),
            [(string) $username]
        );

        if (!$record) {
            return;
        }

        return Account::deserialize($record);
    }
}
