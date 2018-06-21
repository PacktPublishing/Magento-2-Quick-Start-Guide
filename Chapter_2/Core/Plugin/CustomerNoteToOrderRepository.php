<?php

namespace Magelicious\Core\Plugin;

class CustomerNoteToOrderRepository
{
    protected $orderExtensionFactory;
    protected $customerNoteInterfaceFactory;

    public function __construct(
        \Magento\Sales\Api\Data\OrderExtensionFactory $orderExtensionFactory,
        \Magelicious\Core\Api\Data\CustomerNoteInterfaceFactory $customerNoteInterfaceFactory
    )
    {
        $this->orderExtensionFactory = $orderExtensionFactory;
        $this->customerNoteInterfaceFactory = $customerNoteInterfaceFactory;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Model\ResourceModel\Order\Collection $resultOrder
     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function afterGetList(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Model\ResourceModel\Order\Collection $resultOrder
    )
    {
        foreach ($resultOrder->getItems() as $order) {
            $this->afterGet($subject, $order);
        }
        return $resultOrder;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Api\Data\OrderInterface $resultOrder
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    )
    {
        $resultOrder = $this->getCustomerNoteAttribute($resultOrder);
        return $resultOrder;
    }

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $subject
     * @param \Magento\Sales\Api\Data\OrderInterface $resultOrder
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    )
    {
        $resultOrder = $this->saveCustomerNoteAttribute($resultOrder);
        return $resultOrder;
    }

    private function getCustomerNoteAttribute(\Magento\Sales\Api\Data\OrderInterface $resultOrder)
    {
        $extensionAttributes = $resultOrder->getExtensionAttributes() ?: $this->orderExtensionFactory->create();

        // TODO: Get customer note from somewhere (below we fake it)
        $customerNote = $this->customerNoteInterfaceFactory
            ->create()
            ->setCreatedBy('Mark')
            ->setNote('The note ' . \time());

        $extensionAttributes->setCustomerNote($customerNote);

        $resultOrder->setExtensionAttributes($extensionAttributes);

        return $resultOrder;
    }

    private function saveCustomerNoteAttribute(\Magento\Sales\Api\Data\OrderInterface $resultOrder)
    {
        $extensionAttributes = $resultOrder->getExtensionAttributes();

        if ($extensionAttributes && $extensionAttributes->getCustomerNote()) {
            // TODO: Save $extensionAttributes->getCustomerNote() somewhere
        }

        return $resultOrder;
    }
}
