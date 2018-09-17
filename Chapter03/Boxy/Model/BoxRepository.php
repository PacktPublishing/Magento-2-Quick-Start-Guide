<?php

namespace Magelicious\Boxy\Model;

class BoxRepository implements \Magelicious\Boxy\Api\BoxRepositoryInterface
{
    protected $boxFactory;
    protected $boxResourceModel;
    protected $boxCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;

    public function __construct(
        \Magelicious\Boxy\Api\Data\BoxInterfaceFactory $boxFactory,
        \Magelicious\Boxy\Model\ResourceModel\Box $boxResourceModel,
        \Magelicious\Boxy\Model\ResourceModel\Box\CollectionFactory $boxCollectionFactory,
        \Magelicious\Boxy\Api\Data\BoxSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->boxFactory = $boxFactory;
        $this->boxResourceModel = $boxResourceModel;
        $this->boxCollectionFactory = $boxCollectionFactory;
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
        $this->boxResourceModel->load($box, $boxId);
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
        $collection = $this->boxCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
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
