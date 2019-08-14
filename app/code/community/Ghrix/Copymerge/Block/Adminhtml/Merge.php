<?php
class Ghrix_Copymerge_Block_Adminhtml_Merge extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'ghrix_copymerge';
        $this->_controller = 'adminhtml_merge';
        $this->_headerText = $this->__('Category Handler Log');
         
        parent::__construct();
    }
}
