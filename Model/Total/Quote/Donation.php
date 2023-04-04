<?php
namespace Shoyab\Donation\Model\Total\Quote;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote\Address\Total;

/**
 * Class Donation
 * @package Shoyab\Donation\Model\Total\Quote
 */
class Donation extends AbstractTotal
{
    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $_priceCurrency;
    /**
     * Custom constructor.
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        PriceCurrencyInterface $priceCurrency
    ){
        $this->_priceCurrency = $priceCurrency;
    }
    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this|bool
     */
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    )
    {
        parent::collect($quote, $shippingAssignment, $total);
        $baseDonation = 0;
        foreach ($quote->getAllItems() as $item) {
            $baseDonation += $item->getDonation();
        }

        $donation =  $this->_priceCurrency->convert($baseDonation);
        $total->addTotalAmount('donation', $donation);
        $total->addBaseTotalAmount('donation', $baseDonation);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $baseDonation);
        $quote->setDonation($donation);
        $quote->save();
        return $this;
    }
}
