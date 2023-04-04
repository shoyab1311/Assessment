<?php
/**
 * @author: Van Minh - nguyenvanminh.dev@gmail.com
 * @created: 9/24/20 14:45 PM
 */

namespace Shoyab\Donation\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class GroupConfigRenderer
 * @package Shoyab\Donation\Block\Adminhtml\System\Config\Form\Field
 */
class GroupConfigRenderer extends AbstractFieldArray
{
    protected $groupGroupRenderer;

    protected function _construct()
    {
        $this->addColumn(
            'group',
            [
                'label' => __('Amount'),
                'required' => true,
                'class' => 'validate-currency-dollar'
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
        parent::_construct();
    }
}
