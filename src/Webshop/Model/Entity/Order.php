<?php

namespace Webshop\Model\Entity;

class Order implements EntityInterface
{
    const STATUS_WAIT = 'wait';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_READY = 'ready';
    const STATUS_IN_TRANSIT = 'in_transit';
    const STATUS_COMPLETED = 'completed';

    const PAYMENT_STATUS_OPEN = 'open';
    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $account_id;
    /**
     * @var int
     */
    private $payment_method_id;
    /**
     * @var int
     */
    private $discount_code_id;
    /**
     * @var string
     */
    private $deliveryMethod;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $paymentStatus;
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
        $payment_method_id,
        $discount_code_id,
        $deliveryMethod,
        $status,
        $paymentStatus,
        $createdOn,
        $updatedOn
    ) {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->payment_method_id = $payment_method_id;
        $this->discount_code_id = $discount_code_id;
        $this->deliveryMethod = $deliveryMethod;
        $this->status = $status;
        $this->paymentStatus = $paymentStatus;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
    }

    /**
     * @param array $data
     *
     * @return Order
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['id'],
            $data['account_id'],
            $data['payment_method_id'],
            $data['discount_code_id'],
            $data['deliverymethod'],
            $data['status'],
            $data['paymentstatus'],
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
            'payment_method_id' => $this->payment_method_id,
            'discount_code_id' => $this->discount_code_id,
            'deliverymethod' => $this->deliveryMethod,
            'status' => $this->status,
            'paymentstatus' => $this->paymentStatus,
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
     * @return int
     */
    public function getPaymentMethodId()
    {
        return $this->payment_method_id;
    }

    /**
     * @return int
     */
    public function getDiscountCodeId()
    {
        return $this->discount_code_id;
    }

    /**
     * @return string
     */
    public function getDeliveryMethod()
    {
        return $this->deliveryMethod;
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
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
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
