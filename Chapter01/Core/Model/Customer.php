<?php

namespace Magelicious\Core\Model;

class Customer
{
    public function __construct(
        \Magento\Customer\Model\Url $customerUrl
    )
    {
        // With di injection for \Proxy, this returns Magento\Customer\Model\Url\Proxy
        echo get_class($customerUrl);
    }
}
