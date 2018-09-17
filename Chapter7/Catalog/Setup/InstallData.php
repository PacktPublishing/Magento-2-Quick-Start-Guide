<?php

namespace Magelicious\Catalog\Setup;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    protected $searchCriteriaBuilder;
    protected $blockRepository;
    protected $blockFactory;

    public function __construct(
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Cms\Api\BlockRepositoryInterface $blockRepository,
        \Magento\Cms\Api\Data\BlockInterfaceFactory $blockFactory
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->blockRepository = $blockRepository;
        $this->blockFactory = $blockFactory;
    }

    public function install(
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    )
    {
        $setup->startSetup();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('identifier', 'size-guide', 'eq')
            ->create();

        $blocks = $this->blockRepository->getList($searchCriteria)->getItems();

        if (empty($blocks)) {
            /* @var \Magento\Cms\Api\Data\BlockInterface $block */
            $block = $this->blockFactory->create();
            $block->setIdentifier('size-guide');
            $block->setTitle('Size Guide');
            $block->setContent('Size guide!');
            $this->blockRepository->save($block);
        }

        $setup->endSetup();
    }

}
