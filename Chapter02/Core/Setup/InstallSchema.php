<?php

namespace Magelicious\Core\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        // echo 'InstallSchema->install()' . PHP_EOL;

        $table = $setup->getConnection()
            ->newTable($setup->getTable('magelicious_core_log'))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'severity_level',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Severity Level'
            )
            ->addColumn(
                'note',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Note'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'Created At'
            )
            ->setComment('Magelicious Core Log Table');
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
