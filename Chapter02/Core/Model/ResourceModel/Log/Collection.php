<?php

namespace Magelicious\Core\Model\ResourceModel\Log;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Magelicious\Core\Model\Log::class, \Magelicious\Core\Model\ResourceModel\Log::class);
    }
}
