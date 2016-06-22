<?php
namespace Webshop\Model\Service;

use Doctrine\DBAL\DBALException;
use Webshop\Model\Entity\Order;
use Webshop\Model\Entity\OrderLine;
use Webshop\Model\Entity\Product;
use Webshop\Model\Repository\AbstractRepository;
use Webshop\Model\Repository\OrderLineRepository;
use Webshop\Model\Repository\OrderRepository;
use Webshop\Model\Repository\ProductRepository;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderLineRepository
     */
    private $orderLineRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(AbstractRepository $orderRepository, AbstractRepository $orderLineRepository, AbstractRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderLineRepository = $orderLineRepository;
        $this->productRepository = $productRepository;
    }
    
    public function getOrderData($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->find($id);
        $orderLines = $this->orderLineRepository->findByOrderId($order->getId());

        return [
            'order' => $order,
            'orderLines' => $orderLines,
        ];
    }

    public function createFromCart(array $cart, $accountId, $paymentMethodId, $deliveryMethod, $discountCodeId = null)
    {
        $this->orderRepository->insert([
            'account_id' => $accountId,
            'payment_method_id' => $paymentMethodId,
            'discount_code_id' => $discountCodeId,
            'deliverymethod' => $deliveryMethod,
            'status' => Order::STATUS_WAIT,
            'paymentstatus' => Order::PAYMENT_STATUS_OPEN,
        ]);
        
        $orderId = $this->orderRepository->getLastId();

        foreach ($cart as $key => $value) {
            /** @var Product $product */
            $product = $this->productRepository->find($key);

            $i = 1;
            while ($i <= $value) {
                $this->orderLineRepository->insert([
                    'order_id' => (int) $orderId,
                    'product_id' => $product->getId(),
                    'price' => $product->getPrice(),
                    'status' => OrderLine::STATUS_OK,
                ]);

                $i++;
            }
        }

        return $orderId;
    }
}