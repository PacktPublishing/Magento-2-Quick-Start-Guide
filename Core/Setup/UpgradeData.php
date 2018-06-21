<?php

namespace Magelicious\Core\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Sales\Setup\SalesSetupFactory;

class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
{
    protected $salesSetupFactory;

    public function __construct(
        SalesSetupFactory $salesSetupFactory
    )
    {
        $this->salesSetupFactory = $salesSetupFactory;
    }

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
        $salesSetup = $this->salesSetupFactory->create(['setup' => $setup]);

        $salesSetup->addAttribute('order', 'merchant_note', [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'visible' => false,
            'required' => false
        ]);
    }
}
