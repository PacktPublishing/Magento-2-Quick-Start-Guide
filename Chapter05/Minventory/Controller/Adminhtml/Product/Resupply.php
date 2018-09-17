<?php

namespace Magelicious\Minventory\Controller\Adminhtml\Product;

use \Magento\Framework\Controller\ResultFactory;

class Resupply extends \Magelicious\Minventory\Controller\Adminhtml\Product
{
    protected $stockRegistry;
    protected $productRepository;
    protected $resupply;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magelicious\Minventory\Model\Resupply $resupply
    )
    {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
        $this->resupply = $resupply;
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $this->resupply->resupply(
                $this->getRequest()->getParam('id'),
                $_POST['minventory_product']['qty']
            );
            $this->messageManager->addSuccessMessage(__('Successfully resupplied'));
            $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $redirectResult->setPath('minventory/product/index');
        } else {
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->getConfig()->getTitle()->prepend((__('Stock Resupply')));
            return $resultPage;
        }
    }
}
