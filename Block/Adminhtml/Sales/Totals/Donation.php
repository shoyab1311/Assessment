<?php
namespace Shoyab\Donation\Block\Adminhtml\Sales\Totals;

use Magento\Sales\Model\Order;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\DataObject;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Donation extends Template
{
    const TITLE = 'donation/general/title';

    /**
     * @var Order
     */
    protected $_order;
    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;
    /**
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

    public function getSource()
    {
        return $this->_source;
    }

    public function displayFullSummary()
    {
        return true;
    }

    public function getTitle(){
        return $this->scopeConfig->getValue(
            self::TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        if($this->_order->getDonation()!=0){
            $customAmount = new DataObject(
                [
                    'code' => 'donation',
                    'strong' => false,
                    'value' => $this->_order->getDonation(),
                    'label' => __($this->getTitle())
                ]
            );
            $parent->addTotal($customAmount, 'donation');
        }
        return $this;
    }
    /**
     * Get order store object
     *
     * @return \Magento\Store\Model\Store
     */
    public function getStore()
    {
        return $this->_order->getStore();
    }
    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }
    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }
    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }
}
