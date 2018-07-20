<?php

namespace Magelicious\Minventory\Ui\DataProvider\Product;

class ProductDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );

        $this->collection = $collectionFactory->create();

        $this->joinQty();
    }

    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }

        // By default parent's getData already does $this->getCollection()->toArray();
        // However, this is not enough for product collection as we need the "totalRecords and items" structure
        $items = $this->getCollection()->toArray();

        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items),
        ];
    }

    protected function joinQty()
    {
        if ($this->getCollection()) {
            $this->getCollection()->joinField(
                'qty',
                'cataloginventory_stock_item',
                'qty',
                'product_id=entity_id'
            );
        }
    }
}
