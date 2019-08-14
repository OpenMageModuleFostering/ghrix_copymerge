<?php
class Ghrix_Copymerge_Model_Merge extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {  
        $this->_init('ghrix_copymerge/merge');
    }   
    public function toOptionArray($addEmpty = true)
    {
       $cat = Mage::getModel('catalog/category')->load(2);
		$subcats = $cat->getChildren();
        $options[] = array(
			'label' => '----Please select----',
            'value' => '',
            'selected' => 'selected'
			); 
		foreach(explode(',',$subcats) as $subCatid)
		{
		  $_category = Mage::getModel('catalog/category')->load($subCatid);
		  
		  if($_category->getIsActive()) {
			$options[] = array(
			'label' => $_category->getName(),
            'value' => $_category->getId(),
			);
			$sub_cat = Mage::getModel('catalog/category')->load($_category->getId());
			$sub_subcats = $sub_cat->getChildren();
			foreach(explode(',',$sub_subcats) as $sub_subCatid)
			{
				  $_sub_category = Mage::getModel('catalog/category')->load($sub_subCatid);
				  if($_sub_category->getIsActive()) {
					   $options[] = array(
						'label' => '---'.$_sub_category->getName(),
						'value' => $_sub_category->getId()
						);
					  $sub_sub_cat = Mage::getModel('catalog/category')->load($sub_subCatid);
					  $sub_sub_subcats = $sub_sub_cat->getChildren();
					  foreach(explode(',',$sub_sub_subcats) as $sub_sub_subCatid)
					  {
							$_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_subCatid);
							if($_sub_sub_category->getIsActive()) {
								$options[] = array(
								'label' => '-----'.$_sub_sub_category->getName(),
								'value' => $_sub_sub_category->getId()
								);
								
								$sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_subCatid);
					            $sub_sub_sub_subcats = $sub_sub_sub_cat->getChildren();
					            foreach(explode(',',$sub_sub_sub_subcats) as $sub_sub_sub_subCatid)
									  {
											$_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_subCatid);
											if($_sub_sub_sub_category->getIsActive()) {
												$options[] = array(
												'label' => '-------'.$_sub_sub_sub_category->getName(),
												'value' => $_sub_sub_sub_category->getId()
												);
												$sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_subCatid);
					                            $sub_sub_sub_sub_subcats = $sub_sub_sub_sub_cat->getChildren();
												foreach(explode(',',$sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_subCatid)
													  {
															$_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_subCatid);
															if($_sub_sub_sub_sub_category->getIsActive()) {
																$options[] = array(
																'label' => '---------'.$_sub_sub_sub_sub_category->getName(),
																'value' => $_sub_sub_sub_sub_category->getId()
																);
																$sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_subCatid);
																$sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_cat->getChildren();
																foreach(explode(',',$sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_subCatid)
																	  {
																			$_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_subCatid);
																			if($_sub_sub_sub_sub_sub_category->getIsActive()) {
																				$options[] = array(
																				'label' => '-----------'.$_sub_sub_sub_sub_sub_category->getName(),
																				'value' => $_sub_sub_sub_sub_sub_category->getId()
																				);
																				$sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_subCatid);
																				$sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_cat->getChildren();
																				foreach(explode(',',$sub_sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_sub_subCatid)
																					  {
																							$_sub_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_subCatid);
																							if($_sub_sub_sub_sub_sub_sub_category->getIsActive()) {
																								$options[] = array(
																								'label' => '-------------'.$_sub_sub_sub_sub_sub_sub_category->getName(),
																								'value' => $_sub_sub_sub_sub_sub_sub_category->getId()
																								);
																								$sub_sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_subCatid);
																								$sub_sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_sub_cat->getChildren();
																								foreach(explode(',',$sub_sub_sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_sub_sub_subCatid)
																									  {
																											$_sub_sub_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_subCatid);
																											if($_sub_sub_sub_sub_sub_sub_sub_category->getIsActive()) {
																												$options[] = array(
																												'label' => '---------------'.$_sub_sub_sub_sub_sub_sub_sub_category->getName(),
																												'value' => $_sub_sub_sub_sub_sub_sub_sub_category->getId()
																												);
																												$sub_sub_sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_subCatid);
																												$sub_sub_sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_sub_sub_cat->getChildren();
																												foreach(explode(',',$sub_sub_sub_sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_sub_sub_sub_subCatid)
																													  {
																															$_sub_sub_sub_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																															if($_sub_sub_sub_sub_sub_sub_sub_sub_category->getIsActive()) {
																																$options[] = array(
																																'label' => '-----------------'.$_sub_sub_sub_sub_sub_sub_sub_sub_category->getName(),
																																'value' => $_sub_sub_sub_sub_sub_sub_sub_sub_category->getId()
																																);
																																$sub_sub_sub_sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																$sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_sub_sub_sub_cat->getChildren();
																																foreach(explode(',',$sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid)
																																	  {
																																			$_sub_sub_sub_sub_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																			if($_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getIsActive()) {
																																				$options[] = array(
																																				'label' => '-------------------'.$_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getName(),
																																				'value' => $_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getId()
																																				);
																																				$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																				$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_cat->getChildren();
																																				foreach(explode(',',$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid)
																																					  {
																																							$_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																							if($_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getIsActive()) {
																																								$options[] = array(
																																								'label' => '---------------------'.$_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getName(),
																																								'value' => $_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getId()
																																								);
																																								$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																								$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_cat->getChildren();
																																								foreach(explode(',',$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats) as $sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid)
																																									  {
																																											$_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																											if($_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getIsActive()) {
																																												$options[] = array(
																																												'label' => '-----------------------'.$_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getName(),
																																												'value' => $_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_category->getId()
																																												);
																																												$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_cat = Mage::getModel('catalog/category')->load($sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subCatid);
																																												$sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_subcats = $sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_sub_cat->getChildren();
																																												
																																											}
																																									  }
																																							}
																																					  }
																																			}
																																	  }
																															}
																													  }
																											}
																									  }
																							}
																					  }
																			}
																	  }
															}
													  }
											}
									  }
							}
					  }
				   }
			 }
		  }
		}
         return $options;
    }
    
}  
  
