<?php
/**
 * @author: Van Minh - nguyenvanminh.dev@gmail.com
 * @created: 9/24/20 14:45 PM
 */

namespace Shoyab\Donation\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Class Editor
 *
 * @description Block class to define new RTE field.
 * @package     Shoyab\Theme\Block\Adminhtml\System\Config
 */
class Editor extends Field
{
    /**
     * @param Context       $context
     * @param WysiwygConfig $wysiwygConfig
     * @param array         $data
     */
    public function __construct(
        Context $context,
        WysiwygConfig $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setWysiwyg(true);
        $element->setConfig($this->_wysiwygConfig->getConfig($element));
        return parent::_getElementHtml($element);
    }
}
