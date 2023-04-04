<?php

namespace Shoyab\Donation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\Quote;

/**
 * AfterOrderSuccessObserver
 * @package Shoyab/Donation/Observer/
 */
class AfterOrderSuccessObserver implements ObserverInterface
{
    protected $checkoutSession;
    protected $quote;
    public function __construct(
        Quote $quote,
        CheckoutSession $checkoutSession) {
        $this->checkoutSession = $checkoutSession;
        $this->quote = $quote;
    }

    public function execute(Observer $observer)
    {
        /**
         * @var \Magento\Sales\Model\Order $order
         */
        $order = $observer->getOrder();
        $quote = $this->quote->load($order->getQuoteId());
        $donation = 0;
        foreach ($quote->getAllItems() as $quote_item) {
            foreach ($order->getAllItems() as $order_item) {
                if($quote_item->getSku() == $order_item->getSku()){
                    $order_item->setDonation($quote_item->getDonation());
                }
                $donation += $order_item->getDonation();
            }
        }
        $order->setDonation($donation);
        $order->save();
    }
}
