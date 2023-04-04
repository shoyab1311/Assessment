<?php

namespace Shoyab\Donation\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Session as CheckoutSession;

/**
 * Class Donation
 * @package Shoyab/Donation/Observer
 */
class Donation implements ObserverInterface
{
    protected $checkoutSession;
    protected $observer;

    public function __construct(
        CheckoutSession $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }

    public function execute(Observer $observer)
    {
        $params = $observer->getRequest()->getParams();
        $product = $observer->getEvent()->getDataByKey('product');
        $sku_product = $product->getSku();
        $AllItems = $this->checkoutSession->getQuote()->getAllItems();
        $donation = 0;
        $quote = $this->checkoutSession->getQuote();
        foreach ($AllItems as $item) {
            if ($item->getSku() == $sku_product){
                if(!empty($params['check_donation'])) {
                    $item->setDonation($params['money']);
                    $item->save();
                }
            }
            $donation += $item->getDonation();
        }
        $quote->setData('donation', $donation);
        $quote->save();
    }
}
