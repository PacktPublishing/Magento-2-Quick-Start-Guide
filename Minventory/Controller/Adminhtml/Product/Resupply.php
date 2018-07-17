<?php

namespace Magelicious\Minventory\Controller\Adminhtml\Product;

use \Magento\Framework\Controller\ResultFactory;

class Resupply extends \Magelicious\Minventory\Controller\Adminhtml\Product
{
    protected $stockRegistry;
    protected $productRepository;
    protected $logger;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Psr\Log\LoggerInterface $logger
    )
    {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
        $this->logger = $logger;
    }

    public function execute()
    {
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $id = $this->getRequest()->getParam('id');

        try {
            $product = $this->productRepository->getById($id);

            $stockItem = $this->stockRegistry->getStockItemBySku($product->getSku());
            $stockItem->setQty($stockItem->getQty() + 10);
            $stockItem->setIsInStock((bool)$stockItem->getQty());

            // This won't work for all products, composites might not update
            $this->stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);

            $this->messageManager->addSuccessMessage(__('Successfully resupplied %1.', $product->getSku()));
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $redirectResult->setPath('minventory/product/index');
    }
}
