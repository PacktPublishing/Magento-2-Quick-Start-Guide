<?php

namespace Magelicious\Minventory\Ui\DataProvider\Product\Form;

class ProductDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;
    protected $productRepository;
    protected $stockRegistry;
    protected $request;

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Framework\App\RequestInterface $request,
        array $meta = [], array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
        $this->request = $request;
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $id = $this->request->getParam('id');
        $product = $this->productRepository->getById($id);
        $stockItem = $this->stockRegistry->getStockItemBySku($product->getSku());

        $this->loadedData[$product->getId()]['minventory_product'] = [
            'stock' => __('%1 | %2', $product->getSku(), $stockItem->getQty()),
            'qty' => 10
        ];

        return $this->loadedData;
    }
}
