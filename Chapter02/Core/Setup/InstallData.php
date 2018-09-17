<?php

namespace Magelicious\Core\Setup;

use \Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $customerSetupFactory;

    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'free_catalogue',
            [
                'type' => 'int',
                'label' => 'Free Catalogue',
                'input' => 'select',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'default' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::VALUE_NO,
                'required' => 0,
                'sort_order' => 99,
                'position' => 99,
                'system' => 0,
                'visible' => 1,
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
            ]
        );

        $freeCatalogueAttr = $customerSetup
            ->getEavConfig()
            ->getAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'free_catalogue'
            );

        $forms = [
            'adminhtml_customer',
            'checkout_register',
            'customer_account_create',
            'customer_account_edit',
            'adminhtml_checkout'
        ];

        $freeCatalogueAttr->setData('used_in_forms', $forms)
            ->setData('is_used_for_customer_segment', true)
            ->setData('is_system', 0)
            ->setData('is_user_defined', 1)
            ->setData('is_visible', 1)
            ->setData('sort_order', 99);

        $freeCatalogueAttr->save();

        $setup->endSetup();
    }
}