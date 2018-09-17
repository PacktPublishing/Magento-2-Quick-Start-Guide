<?php

namespace Magelicious\Minventory\Model;

class Resupply
{
    protected $productRepository;
    protected $collectionFactory;
    protected $stockRegistry;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
    )
    {
        $this->productRepository = $productRepository;
        $this->collectionFactory = $collectionFactory;
        $this->stockRegistry = $stockRegistry;
    }

    public function resupply($productId, $qty)
    {
        $product = $this->productRepository->getById($productId);
        $stockItem = $this->stockRegistry->getStockItemBySku($product->getSku());
        $stockItem->setQty($stockItem->getQty() + $qty);
        $stockItem->setIsInStock((bool)$stockItem->getQty());
        $this->stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);
    }
}
