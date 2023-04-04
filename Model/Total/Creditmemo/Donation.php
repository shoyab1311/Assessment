<?php

namespace Shoyab\Donation\Model\Total\Creditmemo;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;
use Magento\Sales\Model\Order\Creditmemo;

class Donation extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @return $this
     */
    public function collect(Creditmemo $creditmemo)
    {
        $creditmemo->setDonation(0);

        $amount = $creditmemo->getOrder()->getDonation();
        $creditmemo->setDonation($amount);

        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getDonation());
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getDonation());

        return $this;
    }
}
