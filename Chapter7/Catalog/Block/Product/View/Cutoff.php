<?php

namespace Magelicious\Catalog\Block\Product\View;

class Cutoff extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface
{
    private $product;
    protected $coreRegistry;
    protected $localeDate;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        array $data = []
    )
    {
        $this->coreRegistry = $coreRegistry;
        $this->localeDate = $localeDate;
        parent::__construct($context, $data);
    }

    public function getCutoffAt()
    {
        $timezone = new \DateTimeZone($this->localeDate->getConfigTimezone());
        $now = new \DateTime('now', $timezone);
        $day = strtolower($now->format('l'));
        $cutoffAt = $this->getProduct()->getData($day . '_cutoff_at');
        if ($cutoffAt) {
            $timeForDay = \DateTime::createFromFormat(
                'Y-m-d H:i',
                $now->format('Y-m-d') . ' ' . $cutoffAt,
                $timezone
            );

            if ($timeForDay instanceof \DateTime) {
                return $timeForDay->format(DATE_ISO8601);
            }
        }
        return 0;
    }

    public function getProduct()
    {
        if (!$this->product) {
            $this->product = $this->coreRegistry->registry('product');
        }
        return $this->product;
    }

    public function getIdentities()
    {
        $identities = $this->getProduct()->getIdentities();
        $timezone = new \DateTimeZone($this->localeDate->getConfigTimezone());
        $now = new \DateTime('now', $timezone);
        $day = strtolower($now->format('l'));
        return array_push($identities, $day);
    }
}
