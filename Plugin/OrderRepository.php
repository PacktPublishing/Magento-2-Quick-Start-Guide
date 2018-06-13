<?php

namespace Magelicious\Core\Plugin;

class OrderRepository
{
    protected $orderExtensionFactory;

    public function __construct(
        \Magento\Sales\Api\Data\OrderExtensionFactory $orderExtensionFactory
    )
    {
        $this->orderExtensionFactory = $orderExtensionFactory;
    }


    public function afterGetList(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Model\ResourceModel\Order\Collection $resultOrder
    ) {
        foreach ($resultOrder->getItems() as $order) {
            $this->afterGet($subject, $order);
        }
        return $resultOrder;
    }

    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    )
    {
        $extensionAttributes = $resultOrder->getExtensionAttributes() ?: $this->orderExtensionFactory->create();
        $extensionAttributes->setFancyNote($this->getOrderFancyNote($resultOrder));
        $resultOrder->setExtensionAttributes($extensionAttributes);
        return $resultOrder;
    }

    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    )
    {
        $extensionAttributes = $resultOrder->getExtensionAttributes() ?: $this->orderExtensionFactory->create();

        if ($fancyNote = $extensionAttributes->getFancyNote()) {
            $this->saveOrderFancyNote($resultOrder, $fancyNote);
        }

        return $resultOrder;
    }

    private function saveOrderFancyNote(\Magento\Sales\Api\Data\OrderInterface $order, \Magelicious\Core\Api\Data\FancyNoteInterface $fancyNote)
    {
        // Save order note for this order, either in same DB/table or diff DB/table
    }

    private function getOrderFancyNote(\Magento\Sales\Api\Data\OrderInterface $order)
    {
        // Get order note for this order, either from the same DB/table or diff DB/table
        return \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magelicious\Core\Api\Data\FancyNoteInterface::class)
            ->setCreatedBy('Mark')
            ->setNote('The note ' . \time());
    }
}
