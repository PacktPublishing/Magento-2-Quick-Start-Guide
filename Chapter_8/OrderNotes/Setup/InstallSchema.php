<?php

namespace Magelicious\OrderNotes\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    )
    {
        $connection = $setup->getConnection();

        $connection->addColumn(
            $setup->getTable('quote'),
            'order_notes',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'Order Notes'
            ]
        );

        $connection->addColumn(
            $setup->getTable('sales_order'),
            'order_notes',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'Order Notes'
            ]
        );
    }
}
