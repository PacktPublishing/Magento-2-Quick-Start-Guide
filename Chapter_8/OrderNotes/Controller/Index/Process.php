<?php

namespace Magelicious\OrderNotes\Controller\Index;

class Process extends \Magelicious\OrderNotes\Controller\Index
{
    protected $checkoutSession;
    protected $logger;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        try {

            if ($notes = $this->getRequest()->getParam('order_notes', null)) {
                $quote = $this->checkoutSession->getQuote();
                $quote->setOrderNotes($notes);
                $quote->save();
            }

            $result = [
                'time' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
            ];
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $result = [
                'error' => __('Something went wrong.'),
                'errorcode' => $e->getCode(),
            ];
        }

        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $resultJson->setData($result);
        return $resultJson;
    }
}
