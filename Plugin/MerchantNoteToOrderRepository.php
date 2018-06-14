<?php

namespace Magelicious\Core\Plugin;

class MerchantNoteToOrderRepository
{
    protected $orderExtensionFactory;

    public function __construct(
        \Magento\Sales\Api\Data\OrderExtensionFactory $orderExtensionFactory
    )
    {
        $this->orderExtensionFactory = $orderExtensionFactory;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Model\ResourceModel\Order\Collection $order
     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function afterGetList(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Model\ResourceModel\Order\Collection $order
    )
    {
        foreach ($order->getItems() as $_order) {
            $this->afterGet($subject, $_order);
        }
        return $order;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $order
    )
    {
        $order = $this->getMerchantNoteAttribute($order);
        return $order;
    }

    public function beforeSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $order
    )
    {
        $order = $this->saveMerchantNoteAttribute($order);

        return [$order];
    }

    private function getMerchantNoteAttribute(\Magento\Sales\Api\Data\OrderInterface $order)
    {
        /* @var \Magento\Sales\Api\Data\OrderExtension $extensionAttributes */
        $extensionAttributes = $order->getExtensionAttributes() ?: $this->orderExtensionFactory->create();

        $extensionAttributes->setMerchantNote($order->getData('merchant_note'));

        $order->setExtensionAttributes($extensionAttributes);

        return $order;
    }

    private function saveMerchantNoteAttribute(\Magento\Sales\Api\Data\OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes();

        if ($extensionAttributes && $extensionAttributes->getMerchantNote()) {
            $order->setData('merchant_note', $extensionAttributes->getMerchantNote());
        }

        return $order;
    }
}
