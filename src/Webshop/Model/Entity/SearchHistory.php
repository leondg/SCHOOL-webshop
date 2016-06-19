<?php

namespace Webshop\Model\Entity;

class SearchHistory implements EntityInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $account_id;
    /**
     * @var string
     */
    private $search;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $createdOn;
    /**
     * @var string
     */
    private $updatedOn;

    private function __construct(
        $id,
        $account_id,
        $search,
        $status,
        $createdOn,
        $updatedOn
    ) {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->search = $search;
        $this->status = $status;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['id'],
            $data['account_id'],
            $data['search'],
            $data['status'],
            $data['createdon'],
            $data['updatedon']
        );
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'search' => $this->search,
            'status' => $this->status,
            'createdon' => $this->createdOn,
            'updatedon' => $this->updatedOn,
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return string
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
}
