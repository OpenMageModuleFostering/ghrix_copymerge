<?php
class Ghrix_Copymerge_Block_Adminhtml_Merge_Renderer_Catname extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

public function render(Varien_Object $row)
{

	$catid =  $row->getData($this->getColumn()->getIndex());
	$Category=Mage::getModel('catalog/category')->load($catid);
	$name=$Category->getName();
	
	return $name;

}	
		
}		
