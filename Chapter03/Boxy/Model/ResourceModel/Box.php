<?php

namespace Magelicious\Boxy\Model\ResourceModel;

class Box extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('magelicious_boxy_box', 'entity_id');
    }
}
