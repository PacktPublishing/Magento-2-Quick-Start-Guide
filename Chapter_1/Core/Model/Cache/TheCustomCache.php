<?php

namespace Magelicious\Core\Model\Cache;

class TheCustomCache extends \Magento\Framework\Cache\Frontend\Decorator\TagScope
{
    const TYPE_IDENTIFIER = 'the_custom_cache';
    const CACHE_TAG = 'THE_CUSTOM_CACHE';

    public function __construct(\Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}
