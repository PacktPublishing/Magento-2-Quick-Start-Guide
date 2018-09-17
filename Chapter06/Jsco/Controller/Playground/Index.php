<?php

namespace Magelicious\Jsco\Controller\Playground;

class Index extends \Magelicious\Jsco\Controller\Playground
{
    /**
     * Access like: http://magelicious.loc/jsco/playground
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Playground'));
        return $resultPage;
    }
}
