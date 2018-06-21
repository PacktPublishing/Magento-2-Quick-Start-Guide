<?php

namespace Magelicious\Core\Setup;

use \Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.2') < 0) {
            $this->upgradeToVersionTwoZeroTwo($setup);
        }

        $setup->endSetup();
    }

    private function upgradeToVersionTwoZeroTwo(SchemaSetupInterface $setup)
    {
        echo 'UpgradeSchema->upgradeToVersionTwoZeroTwo()' . PHP_EOL;
    }
}
