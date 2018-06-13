<?php

namespace Magelicious\Core\Model;

class Log extends \Magento\Framework\Model\AbstractModel
{
    // Magento convention <ModuleName>_<ModelName>
    // Suggested convention <VendorName>_<ModuleName>_<ModelName>
    protected $_eventPrefix = 'magelicious_core_log';

    // Magento convention <ModelName>
    protected $_eventObject = 'log';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Magento\Catalog\Model\Product $product,
        array $data = []
    )
    {
        $this->product = $product;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init(\Magelicious\Core\Model\ResourceModel\Log::class);
    }
}
