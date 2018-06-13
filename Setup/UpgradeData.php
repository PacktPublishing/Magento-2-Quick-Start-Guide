<?php

namespace Magelicious\Core\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '2.0.2') < 0) {
            $this->upgradeToVersionTwoZeroTwo($setup);
        }
        $setup->endSetup();
    }

    private function upgradeToVersionTwoZeroTwo(ModuleDataSetupInterface $setup)
    {
        echo 'UpgradeData->upgradeToVersionTwoZeroTwo()' . PHP_EOL;
    }
}
