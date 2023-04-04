<?php

namespace Shoyab\Donation\Block\Adminhtml\Sales\Order\Creditmemo;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\DataObject;
use Magento\Store\Model\ScopeInterface;

class Totals extends Template
{
    const TITLE = 'donation/general/title';

    /**
     * Order invoice
     *
     * @var \Magento\Sales\Model\Order\Creditmemo|null
     */
    protected $_creditmemo = null;

    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;

    /**
     * OrderFee constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get data (totals) source model
     *
     * @return \Magento\Framework\DataObject
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    public function getCreditmemo()
    {
        return $this->getParentBlock()->getCreditmemo();
    }

    public function getTitle(){
        return $this->scopeConfig->getValue(
            self::TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Initialize payment donation totals
     *
     * @return $this
     */
    public function initTotals()
    {
        $this->getParentBlock();
        $this->getCreditmemo();
        $this->getSource();

        if(!$this->getSource()->getDonation()) {
            return $this;
        }
        $donation = new DataObject(
            [
                'code' => 'donation',
                'strong' => false,
                'value' => $this->getSource()->getDonation(),
                'label' => __($this->getTitle())
            ]
        );

        $this->getParentBlock()->addTotalBefore($donation, 'grand_total');

        return $this;
    }
}
