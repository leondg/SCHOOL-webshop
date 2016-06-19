<?php

namespace Webshop\Model\Repository;

use Webshop\Model\Entity\WishListLine;

class WishListLineRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'wish_list_line';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return WishListLine::class;
    }
}
