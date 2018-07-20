<?php

namespace Magelicious\Minventory\Ui\Component\Listing\Columns;

class Resupply extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['resupply'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'minventory/product/resupply',
                        ['id' => $item['entity_id'], 'store' => $storeId]
                    ),
                    'label' => __('Resupply'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
