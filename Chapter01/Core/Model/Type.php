<?php

namespace Magelicious\Core\Model;

class Type
{
    protected $objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        $this->objectManager = $objectManager;
    }

    public function example()
    {
        $this->objectManager->create(\Psr\Log\LoggerInterface::class);

        $this->objectManager->get(\Psr\Log\LoggerInterface::class);

        \Magento\Framework\App\ObjectManager::getInstance()
            ->create(\Psr\Log\LoggerInterface::class);

        \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Psr\Log\LoggerInterface::class);
    }
}
