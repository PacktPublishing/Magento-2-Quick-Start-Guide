<?php

namespace Magelicious\Minventory\Controller\Adminhtml\Product;

use \Magento\Framework\Controller\ResultFactory;

class MassResupply extends \Magelicious\Minventory\Controller\Adminhtml\Product
{
    protected $filter;
    protected $collectionFactory;
    protected $resupply;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magelicious\Minventory\Model\Resupply $resupply
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resupply = $resupply;
    }

    public function execute()
    {
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $qty = $this->getRequest()->getParam('qty');
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $productResupplied = 0;
        foreach ($collection->getItems() as $product) {
            $this->resupply->resupply($product->getId(), $qty);
            $productResupplied++;
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been resupplied.', $productResupplied));

        return $redirectResult->setPath('minventory/product/index');
    }
}
