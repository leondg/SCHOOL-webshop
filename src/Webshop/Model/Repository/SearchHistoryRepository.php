<?php

namespace Webshop\Model\Repository;

use Webshop\Model\Entity\SearchHistory;

class SearchHistoryRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'search_history';
    }

    /**
     * @return string
     */
    public function tableClass()
    {
        SearchHistory::class;
    }
}
