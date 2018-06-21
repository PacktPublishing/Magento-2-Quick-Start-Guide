<?php

namespace Magelicious\Core\Model;

class CustomerNote extends \Magento\Framework\Model\AbstractExtensibleModel implements \Magelicious\Core\Api\Data\CustomerNoteInterface
{
    public function setCreatedBy($createdBy)
    {
        return $this->setData(self::CREATED_BY, $createdBy);
    }

    public function getCreatedBy()
    {
        return $this->getData(self::CREATED_BY);
    }

    public function getNote()
    {
        return $this->getData(self::NOTE);
    }

    public function setNote($note)
    {
        return $this->setData(self::NOTE, $note);
    }
}
