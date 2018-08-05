<?php

namespace Magelicious\OrderNotes\Observer;

class SaveOrderNotesToOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();

        if ($notes = $event->getQuote()->getOrderNotes()) {
            $event->getOrder()
                ->setOrderNotes($notes)
                ->addStatusHistoryComment('Customer note: ' . $notes);
        }

        return $this;
    }
}
