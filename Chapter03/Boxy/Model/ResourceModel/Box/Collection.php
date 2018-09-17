<?php

namespace Magelicious\Boxy\Model\ResourceModel\Box;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Magelicious\Boxy\Model\Box::class, \Magelicious\Boxy\Model\ResourceModel\Box::class);
    }
}
