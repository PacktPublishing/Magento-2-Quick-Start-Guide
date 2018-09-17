<?php

namespace Magelicious\Boxy\Api;

/**
 * Boxy repository interface for boxes.
 * @api
 */
interface BoxRepositoryInterface
{
    /**
     * Save box.
     *
     * @param \Magelicious\Boxy\Api\Data\BoxInterface $box
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Magelicious\Boxy\Api\Data\BoxInterface $box);

    /**
     * Retrieve box.
     *
     * @param int $boxId
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($boxId);

    /**
     * Retrieve boxes matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magelicious\Boxy\Api\Data\BoxSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete box.
     *
     * @param \Magelicious\Boxy\Api\Data\BoxInterface $box
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Magelicious\Boxy\Api\Data\BoxInterface $box);

    /**
     * Delete box by ID.
     *
     * @param int $boxId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($boxId);
}
