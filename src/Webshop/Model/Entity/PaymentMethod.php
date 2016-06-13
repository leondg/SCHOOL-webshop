<?php
namespace Webshop\Model\Entity;

class PaymentMethod
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $price;
    /**
     * @var string
     */
    private $status;
    /**
     * @var
     */
    private $createdOn;
    /**
     * @var
     */
    private $updatedOn;

    /**
     * @param $id
     * @param $name
     * @param $price
     * @param $status
     * @param $createdOn
     * @param $updatedOn
     */
    private function __construct(
        $id,
        $name,
        $price,
        $status,
        $createdOn,
        $updatedOn
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->status = $status;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * @param $data
     * @return PaymentMethod
     */
    public static function deserialize($data)
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['price'],
            $data['status'],
            $data['createdon'],
            $data['updatedon']
        );
    }
}