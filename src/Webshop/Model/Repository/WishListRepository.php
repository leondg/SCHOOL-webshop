<?php
namespace Webshop\Model\Repository;

use Webshop\Model\Entity\WishList;

class WishListRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'wish_list';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        return WishList::class;
    }
}