<?php

namespace Magelicious\Minventory\Controller\Adminhtml\Product;

use \Magento\Framework\Controller\ResultFactory;

class Index extends \Magelicious\Minventory\Controller\Adminhtml\Product
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->getConfig()->getTitle()->prepend((__('Micro Inventory')));

        return $resultPage;
    }
}
