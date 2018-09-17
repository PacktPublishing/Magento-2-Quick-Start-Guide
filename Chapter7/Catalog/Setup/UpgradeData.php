<?php

namespace Magelicious\Catalog\Setup;

class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    )
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $this->upgradeToVersionOneZeroOne($setup);
        }

        $setup->endSetup();

        $this->upgradeToVersionOneZeroOne($setup);
    }

    protected function upgradeToVersionOneZeroOne(\Magento\Framework\Setup\ModuleDataSetupInterface $setup): void
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday'
        ];

        $sortOrder = 100;

        foreach ($days as $day) {
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $day . '_cutoff_at',
                [
                    'type' => 'varchar',
                    'label' => ucfirst($day) . ' Cutoff At',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => $sortOrder++,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'Cutoff',
                ]
            );
        }
    }
}
