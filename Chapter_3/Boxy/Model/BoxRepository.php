<?php

namespace Magelicious\Boxy\Model;

class BoxRepository implements \Magelicious\Boxy\Api\BoxRepositoryInterface
{
    protected $boxFactory;
    protected $boxResourceModel;
    protected $searchResultsFactory;
    protected $collectionProcessor;

    public function __construct(
        \Magelicious\Boxy\Api\Data\BoxInterfaceFactory $boxFactory,
        \Magelicious\Boxy\Model\ResourceModel\Box $boxResourceModel,
        \Magelicious\Boxy\Api\Data\BoxSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->boxFactory = $boxFactory;
        $this->boxResourceModel = $boxResourceModel;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save box.
     *
     * @param \Magelicious\Boxy\Api\Data\BoxInterface $box
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Magelicious\Boxy\Api\Data\BoxInterface $box)
    {
        try {
            $this->boxResourceModel->save($box);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($e->getMessage()));
        }
        return $box;
    }

    /**
     * Retrieve box.
     *
     * @param int $boxId
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($boxId)
    {
        $box = $this->boxFactory->create();
        $this->boxResourceModel->load($boxId, $boxId);
        if (!$box->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Box with id "%1" does not exist.', $boxId));
        }
        return $box;
    }

    /**
     * Retrieve boxes matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->boxFactory->create()->getCollection();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults->setTotalCount($collection->getSize());

        $boxes = [];
        foreach ($collection->getItems() as $box) {
            $boxes[] = $this->getById($box->getId());
        }
        $searchResults->setItems($boxes);

        return $searchResults;
    }

    /**
     * Delete box.
     *
     * @param \Magelicious\Boxy\Api\Data\BoxInterface $box
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Magelicious\Boxy\Api\Data\BoxInterface $box)
    {
        try {
            $this->boxResourceModel->delete($box);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    /**
     * Delete box by ID.
     *
     * @param int $boxId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($boxId)
    {
        return $this->delete($this->getById($boxId));
    }
}
