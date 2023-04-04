<?php

namespace Shoyab\Donation\Block\Adminhtml\Sales\Order\Invoice;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\DataObject;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Totals extends Template
{
    const TITLE = 'donation/general/title';

    /**
     * Order invoice
     *
     * @var \Magento\Sales\Model\Order\Invoice|null
     */
    protected $_invoice = null;

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
        ScopeConfigInterface $scopeConfig,
        Context $context,
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

    public function getInvoice()
    {
        return $this->getParentBlock()->getInvoice();
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
        $this->getInvoice();
        $this->getSource();

        if(!$this->getSource()->getDonation()) {
            return $this;
        }
        $total = new DataObject(
            [
                'code' => 'donation',
                'value' => $this->getSource()->getDonation(),
                'label' =>  __($this->getTitle())
            ]
        );

        $this->getParentBlock()->addTotalBefore($total, 'grand_total');
        return $this;
    }
}
