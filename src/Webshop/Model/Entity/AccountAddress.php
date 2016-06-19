<?php

namespace Webshop\Model\Entity;

class AccountAddress implements EntityInterface
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
    private $name;
    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $number;
    /**
     * @var string
     */
    private $zipCode;
    /**
     * @var string
     */
    private $residence;
    /**
     * @var string
     */
    private $country;
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
        $name,
        $street,
        $number,
        $zipCode,
        $residence,
        $country,
        $status,
        $createdOn,
        $updatedOn
    ) {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->name = $name;
        $this->street = $street;
        $this->number = $number;
        $this->zipCode = $zipCode;
        $this->residence = $residence;
        $this->country = $country;
        $this->status = $status;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * @param array $data
     *
     * @return AccountAddress
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['id'],
            $data['account_id'],
            $data['name'],
            $data['street'],
            $data['number'],
            $data['zipcode'],
            $data['residence'],
            $data['country'],
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
            'name' => $this->name,
            'street' => $this->street,
            'number' => $this->number,
            'zipcode' => $this->zipCode,
            'residence' => $this->residence,
            'country' => $this->country,
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
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
