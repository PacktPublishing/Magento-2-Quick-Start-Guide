<?php

namespace Magelicious\Boxy\Api\Data;

/**
 * @api
 */
interface BoxSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get box list
     *
     * @return \Magelicious\Boxy\Api\Data\BoxInterface[]
     */
    public function getItems();

    /**
     * Set box list
     *
     * @api
     * @param \Magelicious\Boxy\Api\Data\BoxInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}