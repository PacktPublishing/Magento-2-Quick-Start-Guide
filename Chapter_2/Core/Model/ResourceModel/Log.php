<?php

namespace Magelicious\Core\Model\ResourceModel;

class Log extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        // Convention for table name: <VendorName>_<ModuleName>_<EntityName>
        // Convention for identifier column: entity_id
        $this->_init('magelicious_core_log', 'entity_id');
    }
}
