<?php

namespace Shoyab\Donation\Model\Total\Invoice;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;
use Magento\Sales\Model\Order\Invoice;

class Donation extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(Invoice $invoice)
    {
        $amount = $invoice->getOrder()->getDonation();
        $invoice->setDonation($amount);
        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getDonation());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getDonation());
        return $this;
    }
}
