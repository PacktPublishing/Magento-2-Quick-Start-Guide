<?php

namespace Magelicious\ContactPreferences\Model\Entity\Attribute\Source\Contact;

class Preferences extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    const VALUE_EMAIL = 'email';
    const VALUE_PHONE = 'phone';
    const VALUE_POST = 'post';
    const VALUE_SMS = 'sms';

    public function getAllOptions()
    {
        return [
            ['label' => __('Email'), 'value' => self::VALUE_EMAIL],
            ['label' => __('Phone'), 'value' => self::VALUE_PHONE],
            ['label' => __('Post'), 'value' => self::VALUE_POST],
            ['label' => __('SMS'), 'value' => self::VALUE_SMS],
        ];
    }
}
