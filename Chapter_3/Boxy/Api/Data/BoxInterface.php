<?php

namespace Magelicious\Boxy\Api\Data;

/**
 * @api
 */
interface BoxInterface
{
    const BOX_ID = 'box_id';
    const TITLE = 'title';
    const CONTENT = 'content';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return \Magelicious\Boxy\Api\Data\BoxInterface
     */
    public function setContent($content);
}
