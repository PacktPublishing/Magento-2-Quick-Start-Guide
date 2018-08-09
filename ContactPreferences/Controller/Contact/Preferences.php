<?php

namespace Magelicious\ContactPreferences\Controller\Contact;

use Magento\Framework\App\Action\Context;
use phpDocumentor\Reflection\Types\Boolean;

class Preferences extends \Magento\Customer\Controller\AbstractAccount
{
    protected $customerSession;
    protected $customerRepository;
    protected $logger;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
            if ($this->getRequest()->getParam('load')) {
                // This POST is merely to trigger "contact_preferences" section load
            } else {
                try {
                    $preferences = implode(',',
                        array_keys(
                            array_filter($this->getRequest()->getParams(), function ($_checked, $_preference) {
                                return filter_var($_checked, FILTER_VALIDATE_BOOLEAN);
                            }, ARRAY_FILTER_USE_BOTH)
                        )
                    );
                    $customer = $this->customerRepository->getById($this->customerSession->getCustomerId());
                    $customer->setCustomAttribute('contact_preferences', $preferences);
                    $this->customerRepository->save($customer);
                    $this->messageManager->addSuccessMessage(__('Successfully saved contact preferences.'));
                } catch (\Exception $e) {
                    $this->logger->critical($e);
                    $this->messageManager->addSuccessMessage(__('Error saving contact preferences.'));
                }
            }
            return $resultJson;
        } else {
            $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
            $resultPage->getConfig()->getTitle()->set(__('My Contact Preferences'));
            return $resultPage;
        }
    }
}
