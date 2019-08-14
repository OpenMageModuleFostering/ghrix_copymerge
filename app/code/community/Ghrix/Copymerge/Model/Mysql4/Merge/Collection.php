<?php
class Ghrix_Copymerge_Model_Mysql4_Merge_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {  
        $this->_init('ghrix_copymerge/merge');
    }  
}
