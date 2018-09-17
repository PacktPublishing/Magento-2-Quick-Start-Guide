<?php

namespace Magelicious\Boxy\Model;

class Box extends \Magento\Framework\Model\AbstractModel implements \Magelicious\Boxy\Api\Data\BoxInterface
{
    protected function _construct()
    {
        $this->_init(\Magelicious\Boxy\Model\ResourceModel\Box::class);
    }

    /**
     * Get id
     * @return int|mixed|null
     */
    public function getId()
    {
        return $this->getData(self::BOX_ID);
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param int|mixed $id
     * @return \Magelicious\Boxy\Api\Data\BoxInterface|Box|\Magento\Framework\Model\AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::BOX_ID, $id);
    }

    /**
     * @param string $title
     * @return \Magelicious\Boxy\Api\Data\BoxInterface|Box
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @param string $content
     * @return \Magelicious\Boxy\Api\Data\BoxInterface|Box
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}