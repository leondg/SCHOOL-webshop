<?php

namespace Webshop\Model\Entity;

class DiscountCode implements EntityInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $code;
    /**
     * @var int
     */
    private $price;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var int
     */
    private $reusable;
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
        $code,
        $price,
        $name,
        $description,
        $reusable,
        $status,
        $createdOn,
        $updatedOn
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->price = $price;
        $this->name = $name;
        $this->description = $description;
        $this->reusable = $reusable;
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
            $data['code'],
            $data['price'],
            $data['name'],
            $data['description'],
            $data['reusable'],
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
            'code' => $this->code,
            'price' => $this->price,
            'name' => $this->name,
            'description' => $this->description,
            'reusable' => $this->reusable,
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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getReusable()
    {
        return $this->reusable;
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
