<?php

namespace Webshop\Model\Entity;

class WishListLine implements EntityInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $wish_list_id;
    /**
     * @var int
     */
    private $product_id;
    /**
     * @var int
     */
    private $price;
    /**
     * @var string
     */
    private $createdOn;
    /**
     * @var string
     */
    private $updatedOn;

    private function __construct($id, $wish_list_id, $product_id, $price, $createdOn, $updatedOn)
    {
        $this->id = $id;
        $this->wish_list_id = $wish_list_id;
        $this->product_id = $product_id;
        $this->price = $price;
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
            $data['wish_list_id'],
            $data['product_id'],
            $data['price'],
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
            'wish_list_id' => $this->wish_list_id,
            'product_id' => $this->product_id,
            'price' => $this->price,
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
    public function getWishListId()
    {
        return $this->wish_list_id;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
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
