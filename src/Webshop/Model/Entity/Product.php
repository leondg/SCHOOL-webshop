<?php

namespace Webshop\Model\Entity;

class Product implements EntityInterface
{
    const STATUS_ENABLED = 'enabled';
    const STATUS_DISABLED = 'disabled';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $fullName;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $category;
    /**
     * @var int
     */
    private $price;
    /**
     * @var int
     */
    private $msrp;
    /**
     * @var int
     */
    private $stock;
    /**
     * @var array
     */
    private $options;
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

    private function __construct(
        $id,
        $name,
        $fullName,
        $brand,
        $category,
        $price,
        $msrp,
        $stock,
        $options,
        $status,
        $createdOn,
        $updatedOn
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->fullName = $fullName;
        $this->brand = $brand;
        $this->category = $category;
        $this->price = $price;
        $this->msrp = $msrp;
        $this->stock = $stock;
        $this->options = $options;
        $this->status = $status;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * @param array $data
     *
     * @return Product
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['fullname'],
            $data['brand'],
            $data['category'],
            $data['price'],
            $data['msrp'],
            $data['stock'],
            json_decode($data['options'], true),
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
            'name' => $this->name,
            'fullname' => $this->fullName,
            'brand' => $this->brand,
            'category' => $this->category,
            'price' => $this->price,
            'msrp' => $this->msrp,
            'stock' => $this->stock,
            'options' => $this->options,
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getMsrp()
    {
        return $this->msrp;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return mixed
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
}
