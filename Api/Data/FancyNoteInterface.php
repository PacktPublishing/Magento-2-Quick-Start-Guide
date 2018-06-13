<?php

namespace Magelicious\Core\Api\Data;

interface FancyNoteInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const CREATED_BY = 'created_by';
    const NOTE = 'note';

    public function setCreatedBy($createdBy);

    public function getCreatedBy();

    public function setNote($note);

    public function getNote();

    public function getExtensionAttributes();

    public function setExtensionAttributes(
        \Magelicious\Core\Api\Data\FancyNoteExtensionInterface $extensionAttributes
    );
}
