<?php
class Ghrix_Copymerge_Block_Adminhtml_Merge_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'ghrix_copymerge';
        $this->_controller = 'adminhtml_merge';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Action'));
        $this->_updateButton('delete', 'label', $this->__('Delete Action'));
    }  
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
        if (Mage::registry('ghrix_copymerge')->getId()) {
            return $this->__('Edit Action');
        }  
        else {
            return $this->__('New Action');
        }  
    }  
}
