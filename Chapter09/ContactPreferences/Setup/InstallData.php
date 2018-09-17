<?php

namespace Magelicious\ContactPreferences\Setup;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    protected $customerSetupFactory;

    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();

        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'contact_preferences',
            [
                'type' => 'varchar',
                'label' => 'Contact Preferences',
                'input' => 'multiselect',
                'source' => \Magelicious\ContactPreferences\Model\Entity\Attribute\Source\Contact\Preferences::class,
                'required' => 0,
                'sort_order' => 99,
                'position' => 99,
                'system' => 0,
                'visible' => 1,
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
            ]
        );

        $contactPreferencesAttr = $customerSetup
            ->getEavConfig()
            ->getAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'contact_preferences'
            );

        $forms = [
            'adminhtml_customer',
            'customer_account_edit',
        ];

        $contactPreferencesAttr->setData('used_in_forms', $forms)
            ->setData('is_used_for_customer_segment', true)
            ->setData('is_system', 0)
            ->setData('is_user_defined', 1)
            ->setData('is_visible', 1)
            ->setData('sort_order', 99);

        $contactPreferencesAttr->save();

        $setup->endSetup();
    }
}
