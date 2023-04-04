<?php
namespace Shoyab\Donation\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Donation
 * @package Shoyab/Donation/Block
 */
class Donation extends Template
{
    const TITLE = 'donation/general/title';
    const DES = 'donation/general/description';
    const LIST_MONEY_DONATION = 'donation/general/amount_option';
    const IMAGE = 'donation/general/image';
    const ENABLE = 'donation/general/enable';

    protected $scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getTitle(){
        return $this->scopeConfig->getValue(
            self::TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getDescription(){
        return $this->scopeConfig->getValue(
            self::DES,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getListMoney(){
        return $this->scopeConfig->getValue(
            self::LIST_MONEY_DONATION,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getImage(){
        return $this->scopeConfig->getValue(
            self::IMAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function checkEnable(){
        return $this->scopeConfig->getValue(
            self::ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }
}
